<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Certificado;
use App\Http\Requests\StoreCertificadoRequest;
use App\Http\Requests\UpdateCertificadoRequest;
use App\Models\CertificadoModelo;
use App\Models\Participante;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gerar_certificado($participante_id)
    {
        $modelo = CertificadoModelo::findOrFail(1);

        $participante = Participante::findOrFail($participante_id);
        $atividade = Atividade::findOrFail($participante->atividade_id);
        $acao = Acao::findOrFail($atividade->acao_id);


        $data_inicio = date('d/m/Y', strtotime($atividade->data_inicio));
        $data_fim = date('d/m/Y', strtotime($atividade->data_fim));

        switch (date('m'))
        {
            case 1:
                $mes = "Janeiro";
                break;
            case 2:
                $mes = "Fevereiro";
                break;
            case 3:
                $mes = "Março";
                break;
            case 4:
                $mes = "Abril";
                break;
            case 5:
                $mes = "maio";
                break;
            case 6:
                $mes = "Junho";
                break;
            case 7:
                $mes = "Julho";
                break;
            case 8:
                $mes = "Agosto";
                break;
            case 9:
                $mes = "Setembro";
                break;
            case 10:
                $mes = "Outubro";
                break;
            case 11:
                $mes = "Novembro";
                break;
            case 12:
                $mes = "Dezembro";
                break;
            default:
        }


        $antes = array('%participante%', '%acao%', '%nome_atividade%', '%atividade%', '%data_inicio%', '%data_fim%', '%carga_horaria%');
        $depois = array($participante->nome, $acao->titulo, $participante->titulo, $atividade->descricao, $data_inicio, $data_fim,
                        $participante->carga_horaria);

        $modelo->texto = str_replace($antes, $depois, $modelo->texto);

        $imagem = Storage::url($modelo->imagem);

        $pdf = Pdf::loadView('certificado.gerar_certificado', compact('modelo', 'participante', 'imagem', 'mes'));
        $nomePDF = 'certificado.pdf';

        return $pdf->setPaper('a4', 'landscape')->stream($nomePDF);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCertificadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificadoRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function show(Certificado $certificado)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCertificadoRequest  $request
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificadoRequest $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificado  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
