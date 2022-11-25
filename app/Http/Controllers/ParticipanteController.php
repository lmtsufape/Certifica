<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use Illuminate\Http\Request;
use App\Http\Requests\StoreParticipanteRequest;
use App\Http\Requests\UpdateParticipanteRequest;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participantes = Participante::all()->sortBy('id');

        return view('participante.participante_index', ['participantes' => $participantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('participante.participante_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreParticipanteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Participante::create($request->all());

        return redirect(Route('participante.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $participante = Participante::findOrFail($id);

        return view('participante.participante_edit', ['participante' => $participante]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParticipanteRequest  $request
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $participante = Participante::findOrFail($request->id);

        $participante->nome = $request->nome;
        $participante->email = $request->email;
        $participante->cpf = $request->cpf;
        $participante->ativo = $request->ativo;
        $participante->atividade_id = $request->atividade_id;

        $participante->update();

        return redirect(Route('participante.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function delete($participante_id)
    {
        $participante = Participante::findOrFail($participante_id);
        $participante->delete();

        return redirect(Route('participante.index'));
    }
}
