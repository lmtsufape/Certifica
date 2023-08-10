<?php

namespace App\Jobs;

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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Acao $acao)
    {
        $this->acao = $acao;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $certificados = [];
        $zip = new ZipArchive();
        $zipname = sys_get_temp_dir()."/certificados.zip";

        if($zip->open($zipname, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) == true){
            foreach ($this->acao->atividades as $atividade) {
                foreach( $atividade->participantes as $participante){
                    $nomePDF = 'certificado - '.$participante->user->name.'.pdf';
                    array_push($certificados, $nomePDF);

                    $pdf = $this->montar_certificado($participante, $atividade, $this->acao, $nomePDF);

                    $zip->addFile($nomePDF);
                }
            }
        }

        // Fecha arquivo Zip aberto
        $zip->close();

        //exclui os pdf gerados
        foreach ($certificados as $certificado){
            File::delete($certificado);
        }

        //enviar email com os certificados
        Mail::to($this->acao->user->email, $this->acao->user->name)->send(new EnviarZipCertificados([
            'acao'  => $this->acao->titulo,
            'anexo' => $zipname,
        ]));
    }

    private function montar_certificado($participante, $atividade, $acao, $nomePDF){
        Carbon::setLocale('pt_BR');
        $tipo_natureza = TipoNatureza::findOrFail($acao->tipo_natureza_id);
        $natureza = Natureza::findOrFail($tipo_natureza->natureza_id);


        $data_inicio = Carbon::parse($atividade->data_inicio)->isoFormat('LL');
        $data_fim = Carbon::parse($atividade->data_fim)->isoFormat('LL');

        $data_atual = Carbon::parse(Carbon::now())->isoFormat('LL');

        $certificado = Certificado::where('cpf_participante', $participante->user->cpf)->where('atividade_id', $atividade->id)->first();

        $modelo = CertificadoModelo::findOrFail($certificado->certificado_modelo_id);

        $atividade->descricao = Str::lower($atividade->descricao);

        $modelo->texto = CertificadoController::convert_text($modelo, $participante, $acao, $atividade, $natureza, $tipo_natureza);

        $imagem = Storage::url($modelo->fundo);

        $verso = Storage::url($modelo->verso);

        $qrcode = base64_encode(QrCode::generate('http://certifica.ufape.edu.br/validacao/'.$certificado->codigo_validacao));


        $pdf = Pdf::loadView('certificado.gerar_certificado', compact('modelo', 'participante',
                            'imagem', 'data_atual', 'certificado', 'qrcode', 'verso'));


        $pdf->set_option("dpi", 200)->setPaper('a4', 'landscape');
        $pdf->render();
        $output = $pdf->output();


        return file_put_contents($nomePDF, $output);

    }
}
