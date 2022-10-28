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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCertificadoModeloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificadoModeloRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CertificadoModelo  $certificadoModelo
     * @return \Illuminate\Http\Response
     */
    public function show(CertificadoModelo $certificadoModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CertificadoModelo  $certificadoModelo
     * @return \Illuminate\Http\Response
     */
    public function edit(CertificadoModelo $certificadoModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCertificadoModeloRequest  $request
     * @param  \App\Models\CertificadoModelo  $certificadoModelo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificadoModeloRequest $request, CertificadoModelo $certificadoModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CertificadoModelo  $certificadoModelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CertificadoModelo $certificadoModelo)
    {
        //
    }
}
