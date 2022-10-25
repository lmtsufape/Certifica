<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Http\Requests\StoreAcaoRequest;
use App\Http\Requests\UpdateAcaoRequest;

class AcaoController extends Controller
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
     * @param  \App\Http\Requests\StoreAcaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcaoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function show(Acao $acao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function edit(Acao $acao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcaoRequest  $request
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcaoRequest $request, Acao $acao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acao $acao)
    {
        //
    }
}
