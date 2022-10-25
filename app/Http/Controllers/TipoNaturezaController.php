<?php

namespace App\Http\Controllers;

use App\Models\TipoNatureza;
use App\Http\Requests\StoreTipoNaturezaRequest;
use App\Http\Requests\UpdateTipoNaturezaRequest;

class TipoNaturezaController extends Controller
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
     * @param  \App\Http\Requests\StoreTipoNaturezaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoNaturezaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function show(TipoNatureza $tipoNatureza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoNatureza $tipoNatureza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoNaturezaRequest  $request
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoNaturezaRequest $request, TipoNatureza $tipoNatureza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoNatureza $tipoNatureza)
    {
        //
    }
}
