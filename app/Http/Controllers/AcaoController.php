<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use Illuminate\Http\Request;
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
        return view('acao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAcaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        #Acao::create($request->all());

        $acao = new Acao();

        $acao->natureza_id = $request->natureza_id;
        $acao->usuario_id = $request->usuario_id;
        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->status = $request->status;

        $acao->save();

        return redirect(Route('home'));

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
