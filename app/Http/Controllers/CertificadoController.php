<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Http\Requests\StoreCertificadoRequest;
use App\Http\Requests\UpdateCertificadoRequest;

class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificados = Certificado::query()->get();
        return view('certificado.certificado_consult',['certificados' => $certificados]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('certificado.certificado_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCertificadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificadoRequest $request)
    {
        #Certificado::create($request->all());

        $certificado = new Certificado();

        $certificado->atividade_id = $request->atividade_id;
        $certificado->certificado_modelo_id = $request->certificado_modelo_id;
        $certificado->assinatura_esquerda = $request->assinatura_esquerda;
        $certificado->img_fundo = $request->img_fundo;
        $certificado->texto = $request->texto;
        $certificado->logo = $request->logo;

        $certificado->save();

        return redirect(Route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function show(Certificado $certificado)
    {
        $certificados = Certificado::query()->get();
        return view('certificado.certificado_consult',['certificados' => $certificados]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificado = Certificado::query()->findOrFail($id);
        return view('certificado.certificado_edit', ['certificado' => $certificado]);
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
        $certificado = Certificado::query()->findOrFail($id);
        
        $certificado->update([
            'atividade_id' => $request->atividade_id,
            'certificado_modelo_id' => $request->certificado_modelo_id,
            'assinatura_esquerda' => $request->assinatura_esquerda,
            'img_fundo' => $request->img_fundo,
            'texto' => $request->texto,
            'logo' => $request->logo

        ]);
        
        return redirect(Route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificado  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificado = Certificado::query()->findOrFail($id);

        $certificado->delete();

        return redirect(Route('home'));
    }
}