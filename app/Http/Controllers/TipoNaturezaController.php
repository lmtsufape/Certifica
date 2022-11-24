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
        $tipoNaturezas = TipoNatureza::query()->get();
        return view('tipo_natureza.tipo_natureza_consult',['tipo_natureza' => $tipoNaturezas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_natureza.tipo_natureza_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoNaturezaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoNaturezaRequest $request)
    {
        #TipoNatureza::create($request->all());

        $tipo_natureza = new TipoNatureza();

        $tipo_natureza->descricao = $request->descricao;
        

        $tipo_natureza->save();

        return redirect(Route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function show(TipoNatureza $tipo_naturezas)
    {
        $tipo_naturezas = TipoNatureza::query()->get();
        return view('tipo_natureza.tipo_natureza_consult',['tipo_naturezas' => $tipo_naturezas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_natureza = TipoNatureza::query()->findOrFail($id);
        return view('tipo_natureza.tipo_natureza_edit', ['tipo_natureza' => $tipo_natureza]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoNaturezaRequest  $request
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoNaturezaRequest $request, $id)
    {
        $tipo_natureza = TipoNatureza::query()->findOrFail($id);
        
        $tipo_natureza->update([
            'descricao' => $request->descricao
        ]);
        
        return redirect(Route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_natureza = TipoNatureza::query()->findOrFail($id);

        $tipo_natureza->delete();

        return redirect(Route('home'));
    }
}
