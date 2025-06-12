<?php

namespace App\Jobs;

use App\Models\InfoExternaParticipante;
use App\Models\Trabalho;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Acao;
use App\Models\TipoNatureza;
use App\Models\Natureza;
use App\Models\Certificado;
use App\Models\CertificadoModelo;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\CertificadoController;
use ZipArchive;
use File;
use Throwable;
use Carbon\Carbon;
use App\Mail\EnviarZipCertificados;
use App\Models\Curso;
use Illuminate\Support\Facades\File as FileFacade;

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
        $certificados = [];
        $zip = new ZipArchive();
        $batchCount = 0; // Contador para controlar os lotes

        $caminho = Storage::path("certificados_".str_replace(' ', '_', $this->acao->titulo));
        Storage::makeDirectory("certificados_".str_replace(' ', '_', $this->acao->titulo));
        $zipname = $caminho.DIRECTORY_SEPARATOR."certificados.zip";

        if ($zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE) == true) {
            foreach ($this->acao->atividades as $atividade) {
                foreach ($atividade->participantes as $participante) {
                    $nomePDF = $caminho.DIRECTORY_SEPARATOR.'Certificado '.$atividade->descricao.' - '.$participante->user->name.'.pdf';
                    array_push($certificados, $nomePDF);

                    $pdf = $this->montar_certificado($participante, $atividade, $nomePDF);

                    $zip->addFile($nomePDF, 'Certificado '.$atividade->descricao.' - '.$participante->user->name.'.pdf');

                    $batchCount++;

                    if ($batchCount >= 10) {
                        $batchCount = 0;
                    }
                }
            }

            $zip->close();
        }

        foreach ($certificados as $certificado) {
            Storage::delete($certificado);
        }

        Mail::to($this->acao->user->email, $this->acao->user->name)->send(new EnviarZipCertificados([
            'acao'  => $this->acao->titulo,
            'anexo' => $zipname,
        ]));

        $caminho_excluir = "certificados_".str_replace(' ', '_', $this->acao->titulo);

        ExcluirCertificados::dispatch($caminho_excluir)->delay(now()->addHours(2));
    }

    private function montar_certificado($participante, $atividade, $nomePDF)
    {
        Carbon::setLocale('pt_BR');

        $autorTrabalhoId = $participante->autor_trabalhos_id;
        $coautorTrabalhoId = $participante->coautor_trabalhos_id;

        $trabalho = Trabalho::whereIn('id', [$autorTrabalhoId, $coautorTrabalhoId])->first();

        $acao = Acao::findOrFail($atividade->acao_id);

        $tipo_natureza = TipoNatureza::findOrFail($acao->tipo_natureza_id);
        $natureza = Natureza::findOrFail($tipo_natureza->natureza_id);

        if($acao->data_personalizada) {
            $data_atual = Carbon::parse($acao->data_personalizada)->isoFormat('LL');
        }
        else {
            $data_atual = Carbon::parse(Carbon::now())->isoFormat('LL');
        }

        if($participante->user->cpf) {
            $certificado = Certificado::where('cpf_participante', $participante->user->cpf)->where('atividade_id', $atividade->id)->first();
        }
        else {
            $certificado = Certificado::where('cpf_participante', $participante->user->passaporte)->where('atividade_id', $atividade->id)->first();
        }

        $modelo = CertificadoModelo::findOrFail($certificado->certificado_modelo_id);


        //$atividade->descricao = Str::lower($atividade->descricao);

        if($atividade->data_inicio == $atividade->data_fim && $modelo->texto_um_dia != null) {
            $modelo->texto = $modelo->texto_um_dia;
        }

        if(mb_strlen($modelo->texto) <= 380) {
            $tamanho_fonte = 38;
        }
        else {
            $tamanho_fonte = 38;
            $excesso_caracteres = mb_strlen($modelo->texto) - 380;

            if ($excesso_caracteres > 0) {
                $reducoes_tamanho = ceil($excesso_caracteres / 65);
                $tamanho_fonte -= $reducoes_tamanho * 2;
            }

            $tamanho_fonte = intval($tamanho_fonte);
        }

        $modelo->texto = $this->convert_text($modelo, $participante, $acao, $atividade, $natureza, $tipo_natureza, $trabalho);
       
        $imagem = Storage::url($modelo->fundo);

        $verso = Storage::url($modelo->verso);

        $qrcode = base64_encode(QrCode::generate('http://certifica.ufape.edu.br/validacao/'.$certificado->codigo_validacao));


        $pdf = Pdf::loadView('certificado.gerar_certificado', compact('modelo', 'participante',
                            'imagem', 'data_atual', 'certificado', 'qrcode', 'verso', 'tamanho_fonte'));


        $pdf->set_option("dpi", 150)->setPaper('a4', 'landscape');
        $pdf->render();
        $output = $pdf->output();

        return file_put_contents($nomePDF, $output);
    }

    private static function convert_text($modelo, $participante, $acao, $atividade, $natureza, $tipo_natureza, $trabalho){
        $data_inicio = Carbon::parse($atividade->data_inicio)->isoFormat('LL');
        $data_fim = Carbon::parse($atividade->data_fim)->isoFormat('LL');

        $pattern = '/\*[\wÀ-ú\%\.\,\_\-\(\)\#\@\!\'\ "]+\*/i';
        $replace = '<b>$0</b>';

        $modelo->texto = preg_replace($pattern, $replace, $modelo->texto);
        $user = $participante->user;
        $curso = json_decode($user->json_cursos_ids) ;

        if($curso){
            $curso =  (int) reset($curso);
            $curso = Curso::find($curso);

            if($curso){
                $curso = $curso->nome;
            }
        }

        if($atividade->descricao == "apresentação de trabalho")
        {
            if ($trabalho->nomesCoautoresComoTexto() == null) {
                $modelo->texto = str_replace('tendo como coautores %coautores_trabalho%,', '', $modelo->texto);

            }
        }

        if($trabalho){
            $antes = array('%participante%', '%acao%', '%nome_atividade%', '%atividade%', '%data_inicio%', '%data_fim%', '%carga_horaria%', '%natureza%', '%tipo_natureza%', '*',
                '%titulo_trabalho%', '%autores_trabalho%', '%coautores_trabalho%', '%curso%', '%titulo_atividade%');
            $depois = array($participante->user->name, $acao->titulo, $participante->titulo, $atividade->descricao, $data_inicio, $data_fim, $participante->carga_horaria,
                $natureza->descricao, $tipo_natureza->descricao, '', $trabalho->titulo, $trabalho->nomesAutoresComoTexto(), $trabalho->nomesCoautoresComoTexto(), $curso, $atividade->titulo);

        } 
        else{
            $antes = array('%participante%', '%acao%', '%nome_atividade%', '%atividade%', '%data_inicio%', '%data_fim%', '%carga_horaria%', '%natureza%', '%tipo_natureza%', '*', '%curso%', '%titulo_atividade%');
            $depois = array($participante->user->name, $acao->titulo, $participante->titulo, $atividade->descricao, $data_inicio, $data_fim,
                $participante->carga_horaria, $natureza->descricao, $tipo_natureza->descricao, '', $curso, $atividade->titulo);

        }

        return str_replace($antes, $depois, $modelo->texto);
    }
}
