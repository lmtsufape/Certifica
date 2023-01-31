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
        $acaos = Acao::all()->sortBy('id');

        return view('acao.acao_index', ['acaos' => $acaos]);
    }

    public function list(){
        return view('acao.list');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acao.acao_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAcaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $acao = new Acao();

        $acao->natureza_id = $request->natureza_id;
        $acao->usuario_id = $request->usuario_id;
        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->status = $request->status;

        $acao->save();

        return redirect(Route('acao.index'));


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
    public function edit($id)
    {
        $acao = Acao::findOrFail($id);

        return view('acao.acao_edit', ['acao' => $acao]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcaoRequest  $request
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $acao = Acao::findOrFail($request->id);

        $acao->natureza_id = $request->natureza_id;
        $acao->usuario_id = $request->usuario_id;
        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->status = $request->status;

        $acao->update();

        return redirect(Route('acao.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function delete($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);
        $acao->delete();

        return redirect(Route('acao.index'));
    }
}
