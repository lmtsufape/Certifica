<?php

namespace App\Http\Controllers;

use App\Models\AcaoStatus;
use App\Http\Requests\StoreAcaoStatusRequest;
use App\Http\Requests\UpdateAcaoStatusRequest;

class AcaoStatusController extends Controller
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
     * @param  \App\Http\Requests\StoreAcaoStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcaoStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcaoStatus  $acaoStatus
     * @return \Illuminate\Http\Response
     */
    public function show(AcaoStatus $acaoStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcaoStatus  $acaoStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(AcaoStatus $acaoStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcaoStatusRequest  $request
     * @param  \App\Models\AcaoStatus  $acaoStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcaoStatusRequest $request, AcaoStatus $acaoStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcaoStatus  $acaoStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcaoStatus $acaoStatus)
    {
        //
    }
}
