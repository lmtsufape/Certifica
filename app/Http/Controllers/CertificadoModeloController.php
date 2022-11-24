<?php

namespace App\Http\Controllers;

use App\Models\CertificadoModelo;
use App\Http\Requests\StoreCertificadoModeloRequest;
use App\Http\Requests\UpdateCertificadoModeloRequest;

class CertificadoModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificado_modelos = CertificadoModelo::query()->get();
        return view('certificado_modelo.certificado_modelo_consult',['certificado_modelos' => $certificado_modelos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('certificado_modelo.certificado_modelo_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCertificadoModeloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificadoModeloRequest $request)
    {
        #TipoNatureza::create($request->all());

        $certificado_modelo = new CertificadoModelo();

        $certificado_modelo->unidade_administrativa_id = $request->unidade_administrativa_id;
        $certificado_modelo->assinatura_esquerda = $request->assinatura_esquerda;
        $certificado_modelo->assinatura_direita = $request->assinatura_direita;
        $certificado_modelo->data_posicao = $request->data_posicao;
        $certificado_modelo->texto_posicao = $request->texto_posicao;

        $certificado_modelo->save();

        return redirect(Route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function show(CertificadoModelo $certificado_modelo)
    {
        $certificado_modelos = CertificadoModelo::query()->get();
        return view('certificado_modelo.certificado_modelo_consult',['certificado_modelos' => $certificado_modelos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificado_modelo = CertificadoModelo::query()->findOrFail($id);
        return view('certificado_modelo.certificado_modelo_edit', ['certificado_modelo' => $certificado_modelo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCertificadoModeloRequest  $request
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificadoModeloRequest $request, $id)
    {
        $certificado_modelo = CertificadoModelo::query()->findOrFail($id);
        
        $certificado_modelo->update([
            'data_posicao' => $request->data_posicao,
            'assinatura_direita' => $request->assinatura_direita,
            'assinatura_esquerda' => $request->assinatura_esquerda,
            'unidade_administrativa_id' => $request->unidade_administrativa_id,
            'texto_posicao' => $request->texto_posicao

        ]);
        
        return redirect(Route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CertificadoModelo  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificado_modelo = CertificadoModelo::query()->findOrFail($id);

        $certificado_modelo->delete();

        return redirect(Route('home'));
    }
}
