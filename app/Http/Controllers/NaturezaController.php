<?php

namespace App\Http\Controllers;

use App\Models\Natureza;
use App\Models\UnidadeAdministrativa;
use Illuminate\Http\Request;
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
        $naturezas = Natureza::all()->sortBy('id');

        return view('natureza.natureza_index', ['naturezas' => $naturezas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('natureza.natureza_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNaturezaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Natureza::create($request->all());

        return redirect(Route('natureza.index'));
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
    public function edit($id)
    {
        $natureza = Natureza::findOrFail($id);

        return view('natureza.natureza_edit', ['natureza' => $natureza]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNaturezaRequest  $request
     * @param  \App\Models\Natureza  $natureza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $natureza = Natureza::findOrFail($request->id);

        $natureza->descricao = $request->descricao;
        $natureza->tipo_natureza_id = $request->tipo_natureza_id;
        $natureza->unidade_administrativa_id = $request->unidade_administrativa_id;

        $natureza->update();

        return redirect(Route('natureza.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Natureza  $natureza
     * @return \Illuminate\Http\Response
     */
    public function delete($natureza_id)
    {
        $natureza = Natureza::findOrFail($natureza_id);
        $natureza->delete();

        return redirect(Route('natureza.index'));
    }
}
