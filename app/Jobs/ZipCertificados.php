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
                    $nomePDF = $caminho.DIRECTORY_SEPARATOR.'certificado - '.$participante->user->name.'.pdf';
                    array_push($certificados, $nomePDF);

                    $pdf = $this->montar_certificado($participante, $atividade, $nomePDF);

                    $zip->addFile($nomePDF, 'certificado - '.$participante->user->name.'.pdf');

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
        $tipo_natureza = TipoNatureza::findOrFail($this->acao->tipo_natureza_id);
        $natureza = Natureza::findOrFail($tipo_natureza->natureza_id);

        $data_inicio = Carbon::parse($atividade->data_inicio)->isoFormat('LL');
        $data_fim = Carbon::parse($atividade->data_fim)->isoFormat('LL');

        $autorTrabalhoId = $participante->autor_trabalhos_id;
        $coautorTrabalhoId = $participante->coautor_trabalhos_id;

        $trabalho = Trabalho::whereIn('id', [$autorTrabalhoId, $coautorTrabalhoId])->first();

        $info_extra_participante = $participante->info_externa_participante_id;
        if($info_extra_participante){
            $info_extra_participante = InfoExternaParticipante::findOrFail($info_extra_participante);
        }

        $data_atual = Carbon::parse(Carbon::now())->isoFormat('LL');

        $certificado = Certificado::where('cpf_participante', $participante->user->cpf)->where('atividade_id', $atividade->id)->first();

        $modelo = CertificadoModelo::findOrFail($certificado->certificado_modelo_id);

        $atividade->descricao = Str::lower($atividade->descricao);

        $modelo->texto = CertificadoController::convert_text($modelo, $participante, $this->acao, $atividade, $natureza, $tipo_natureza,$trabalho,$info_extra_participante );

        $imagem = Storage::url($modelo->fundo);

        $verso = Storage::url($modelo->verso);

        $logo = Storage::url($modelo->logo);

        $qrcode = base64_encode(QrCode::generate('http://certifica.ufape.edu.br/validacao/'.$certificado->codigo_validacao));


        $pdf = Pdf::loadView('certificado.gerar_certificado', compact('modelo', 'participante',
                            'imagem', 'data_atual', 'certificado', 'qrcode', 'verso', 'logo'));


        $pdf->set_option("dpi", 150)->setPaper('a4', 'landscape');
        $pdf->render();
        $output = $pdf->output();


        return file_put_contents($nomePDF, $output);
    }
}
