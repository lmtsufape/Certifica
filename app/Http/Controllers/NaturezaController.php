<?php

namespace App\Http\Controllers;

use App\Models\Natureza;
use App\Http\Requests\StoreNaturezaRequest;
use App\Http\Requests\UpdateNaturezaRequest;

class NaturezaController extends Controller
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
     * @param  \App\Http\Requests\StoreNaturezaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNaturezaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Natureza  $natureza
     * @return \Illuminate\Http\Response
     */
    public function show(Natureza $natureza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Natureza  $natureza
     * @return \Illuminate\Http\Response
     */
    public function edit(Natureza $natureza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNaturezaRequest  $request
     * @param  \App\Models\Natureza  $natureza
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNaturezaRequest $request, Natureza $natureza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Natureza  $natureza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Natureza $natureza)
    {
        //
    }
}
