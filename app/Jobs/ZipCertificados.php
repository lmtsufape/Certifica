<?php

namespace App\Jobs;

use App\Models\Trabalho;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\Acao;
use App\Models\TipoNatureza;
use App\Models\Natureza;
use App\Models\Certificado;
use App\Models\CertificadoModelo;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;
use Carbon\Carbon;
use App\Mail\EnviarZipCertificados;
use App\Models\Curso;

class ZipCertificados implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $acao;

    public function __construct(Acao $acao)
    {
        $this->acao = $acao;
    }

    public function handle()
    {
        $zip = new ZipArchive();

        $caminho = Storage::path("certificados_" . str_replace(' ', '_', $this->acao->titulo));
        Storage::makeDirectory("certificados_" . str_replace(' ', '_', $this->acao->titulo));
        $zipname = $caminho . DIRECTORY_SEPARATOR . "certificados.zip";

        if ($zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($this->acao->atividades()->lazy() as $atividade) {
                foreach ($atividade->participantes()->lazy() as $participante) {
                    $fileName = 'Certificado ' . $atividade->descricao . ' - ' . $participante->user->name . '.pdf';
                    $pdfContent = $this->montar_certificado($participante, $atividade);
                    $zip->addFromString($fileName, $pdfContent);
                    unset($pdfContent);
                    gc_collect_cycles();
                }
            }

            $zip->close();
        }

        Mail::to($this->acao->user->email, $this->acao->user->name)->send(new EnviarZipCertificados([
            'acao'  => $this->acao->titulo,
            'anexo' => $zipname,
        ]));

        $caminho_excluir = "certificados_" . str_replace(' ', '_', $this->acao->titulo);

        ExcluirCertificados::dispatch($caminho_excluir)->delay(now()->addHours(24));
    }
    private function montar_certificado($participante, $atividade)
    {
        Carbon::setLocale('pt_BR');

        $autorTrabalhoId = $participante->autor_trabalhos_id;
        $coautorTrabalhoId = $participante->coautor_trabalhos_id;

        $trabalho = Trabalho::whereIn('id', [$autorTrabalhoId, $coautorTrabalhoId])->first();
        $info_extra_participante = $participante->infoExterna;

        $acao = Acao::findOrFail($atividade->acao_id);

        $tipo_natureza = TipoNatureza::findOrFail($acao->tipo_natureza_id);
        $natureza = Natureza::findOrFail($tipo_natureza->natureza_id);

        if ($acao->data_personalizada) {
            $data_atual = Carbon::parse($acao->data_personalizada)->isoFormat('LL');
        } else {
            $data_atual = Carbon::parse(Carbon::now())->isoFormat('LL');
        }

        if ($participante->user->cpf) {
            $certificado = Certificado::where('cpf_participante', $participante->user->cpf)->where('atividade_id', $atividade->id)->first();
        } else {
            $certificado = Certificado::where('cpf_participante', $participante->user->passaporte)->where('atividade_id', $atividade->id)->first();
        }

        $modelo = CertificadoModelo::findOrFail($certificado->certificado_modelo_id);

        if ($atividade->data_inicio == $atividade->data_fim && $modelo->texto_um_dia != null) {
            $modelo->texto = $modelo->texto_um_dia;
        }

        if (mb_strlen($modelo->texto) <= 380) {
            $tamanho_fonte = 38;
        } else {
            $tamanho_fonte = 38;
            $excesso_caracteres = mb_strlen($modelo->texto) - 380;

            if ($excesso_caracteres > 0) {
                $reducoes_tamanho = ceil($excesso_caracteres / 65);
                $tamanho_fonte -= $reducoes_tamanho * 2;
            }

            $tamanho_fonte = intval($tamanho_fonte);
        }

        $modelo->texto = $this->convert_text($modelo, $participante, $acao, $atividade, $natureza, $tipo_natureza, $trabalho, $info_extra_participante);

        $imagem = Storage::url($modelo->fundo);

        $verso = Storage::url($modelo->verso);

        $qrcode = base64_encode(QrCode::generate('http://certifica.ufape.edu.br/validacao/' . $certificado->codigo_validacao));

        $pdf = Pdf::loadView('certificado.gerar_certificado', compact(
            'modelo',
            'participante',
            'imagem',
            'data_atual',
            'certificado',
            'qrcode',
            'verso',
            'tamanho_fonte'
        ));

        $pdf->set_option("dpi", 150)->setPaper('a4', 'landscape');
        $pdf->render();
        $output = $pdf->output();
        unset($pdf);

        return $output;
    }

    private static function convert_text($modelo, $participante, $acao, $atividade, $natureza, $tipo_natureza, $trabalho, $info_extra_participante)
    {
        $data_inicio = Carbon::parse($atividade->data_inicio)->isoFormat('LL');
        $data_fim = Carbon::parse($atividade->data_fim)->isoFormat('LL');

        $inicioParticipante = $info_extra_participante && $info_extra_participante->data_inicio
            ? Carbon::parse($info_extra_participante->data_inicio)->isoFormat('LL')
            : $data_inicio;
        $terminoParticipante = $info_extra_participante && $info_extra_participante->data_fim
            ? Carbon::parse($info_extra_participante->data_fim)->isoFormat('LL')
            : $data_fim;

        $descricaoTipoNatureza = $info_extra_participante && $info_extra_participante->tipo_natureza_participante
            ? $info_extra_participante->tipo_natureza_participante
            : $tipo_natureza->descricao;

        if ($info_extra_participante) {
            $modelo->texto = str_replace(
                ['%titulo_plano%', '%cpf_orientador%', '%nome_orientador%', '%email_orientador%', '%tipo_natureza_participante%', '%inicio%', '%termino%'],
                [
                    $info_extra_participante->titulo_plano,
                    $info_extra_participante->orientador_cpf,
                    $info_extra_participante->orientador,
                    $info_extra_participante->orientador_email,
                    $descricaoTipoNatureza,
                    $inicioParticipante,
                    $terminoParticipante,
                ],
                $modelo->texto
            );
        }

        $pattern = '/\*[\wÀ-ú\%\.\,\_\-\(\)\#\@\!\'\ "]+\*/i';
        $replace = '<b>$0</b>';

        $modelo->texto = preg_replace($pattern, $replace, $modelo->texto);
        $user = $participante->user;
        $curso = json_decode($user->json_cursos_ids);

        if ($curso) {
            $curso =  (int) reset($curso);
            $curso = Curso::find($curso);

            if ($curso) {
                $curso = $curso->nome;
            }
        }

        if ($atividade->descricao == "apresentação de trabalho") {
            if ($trabalho->nomesCoautoresComoTexto() == null) {
                $modelo->texto = str_replace('tendo como coautores %coautores_trabalho%,', '', $modelo->texto);
            }
        }

        if ($trabalho) {
            $antes = array(
                '%participante%',
                '%acao%',
                '%nome_atividade%',
                '%atividade%',
                '%data_inicio%',
                '%data_fim%',
                '%carga_horaria%',
                '%natureza%',
                '%tipo_natureza%',
                '*',
                '%titulo_trabalho%',
                '%autores_trabalho%',
                '%coautores_trabalho%',
                '%curso%',
                '%titulo_atividade%'
            );
            $depois = array(
                $participante->user->name,
                $acao->titulo,
                $participante->titulo,
                $atividade->descricao,
                $data_inicio,
                $data_fim,
                $participante->carga_horaria,
                $natureza->descricao,
                $tipo_natureza->descricao,
                '',
                $trabalho->titulo,
                $trabalho->nomesAutoresComoTexto(),
                $trabalho->nomesCoautoresComoTexto(),
                $curso,
                $atividade->titulo
            );
        } elseif ($info_extra_participante) {
            $antes = array('%participante%', '%acao%', '%nome_atividade%', '%atividade%', '%data_inicio%', '%data_fim%', '%carga_horaria%', '%natureza%', '%tipo_natureza%', '*', '%curso%',
                '%orientador%', '%periodo_letivo%', '%disciplina%', '%area%', '%titulo_projeto%', '%local_realizado%', '%titulo_atividade%',
                '%titulo_plano%', '%cpf_orientador%', '%nome_orientador%', '%email_orientador%', '%inicio%', '%termino%');
            $depois = array(
                $participante->user->name, $acao->titulo, $participante->titulo, $atividade->descricao, $data_inicio, $data_fim,
                $participante->carga_horaria, $natureza->descricao, $tipo_natureza->descricao, '', $curso,
                $info_extra_participante->orientador, $info_extra_participante->periodo_letivo, $info_extra_participante->disciplina,
                $info_extra_participante->area, $info_extra_participante->titulo_projeto, $info_extra_participante->local_realizado,
                $atividade->titulo, $info_extra_participante->titulo_plano, $info_extra_participante->orientador_cpf,
                $info_extra_participante->orientador, $info_extra_participante->orientador_email, $inicioParticipante, $terminoParticipante
            );
        } else {
            $antes = array('%participante%', '%acao%', '%nome_atividade%', '%atividade%', '%data_inicio%', '%data_fim%', '%carga_horaria%', '%natureza%', '%tipo_natureza%', '*', '%curso%', '%titulo_atividade%');
            $depois = array(
                $participante->user->name,
                $acao->titulo,
                $participante->titulo,
                $atividade->descricao,
                $data_inicio,
                $data_fim,
                $participante->carga_horaria,
                $natureza->descricao,
                $tipo_natureza->descricao,
                '',
                $curso,
                $atividade->titulo
            );
        }

        return str_replace($antes, $depois, $modelo->texto);
    }
}
