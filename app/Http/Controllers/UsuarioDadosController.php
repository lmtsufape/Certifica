<?php

namespace App\Http\Controllers;

use App\Models\UsuarioDados;
use App\Http\Requests\StoreUsuarioDadosRequest;
use App\Http\Requests\UpdateUsuarioDadosRequest;

class UsuarioDadosController extends Controller
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
     * @param  \App\Http\Requests\StoreUsuarioDadosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuarioDadosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsuarioDados  $usuarioDados
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioDados $usuarioDados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsuarioDados  $usuarioDados
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuarioDados $usuarioDados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsuarioDadosRequest  $request
     * @param  \App\Models\UsuarioDados  $usuarioDados
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsuarioDadosRequest $request, UsuarioDados $usuarioDados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsuarioDados  $usuarioDados
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuarioDados $usuarioDados)
    {
        //
    }
}
