<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAtividadeRequest;
use App\Http\Requests\UpdateAtividadeRequest;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atividades = Atividade::all()->sortBy('id');

        return view('atividade.atividade_index', ['atividades' => $atividades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('atividade.atividade_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAtividadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Atividade::create($request->all());

        return redirect(Route('atividade.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atividade = Atividade::findOrFail($id);

        return view('atividade.atividade_edit', ['atividade' => $atividade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAtividadeRequest  $request
     * @param  \App\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $atividade = Atividade::findOrFail($request->id);

        $atividade->status = $request->status;
        $atividade->descricao = $request->descricao;
        $atividade->info = $request->info;
        $atividade->data_inicio = $request->data_inicio;
        $atividade->data_fim = $request->data_fim;
        $atividade->carga_horaria = $request->carga_horaria;
        $atividade->acao_id = $request->acao_id;

        $atividade->update();

        return redirect(Route('atividade.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function delete($atividade_id)
    {
        $atividade = Atividade::findOrFail($atividade_id);
        $atividade->delete();

        return redirect(Route('atividade.index'));
    }
}
