<?php

namespace App\Http\Controllers;

use App\Models\TipoNatureza;
use App\Http\Requests\StoreTipoNaturezaRequest;
use App\Http\Requests\UpdateTipoNaturezaRequest;
use App\Validates\TipoNaturezaValidator;
use Illuminate\Validation\ValidationException;


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
        try {
            TipoNaturezaValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('tipo_natureza.create'))->withErrors($exception->validator)->withInput();
        }

        TipoNatureza::create($request->all());

        return redirect(route('tipo_natureza.index'))->with(['mensagem' => 'Tipo de Natureza cadastrada com sucesso!']);
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
        try{
            TipoNaturezaValidator::validate($request->all());
        } catch (ValidationException $exception){
            return redirect(route('tipo_natureza.edit', ['id'=>$id]))->withErrors($exception->validator)->withInput();
        }

        $tipo_natureza = TipoNatureza::findOrFail($id);
        
        $tipo_natureza->update([
            'descricao' => $request->descricao
        ]);
        
        return redirect(Route('tipo_natureza.index'))->with(['mensagem' => 'Tipo de Natureza atualizado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_natureza = TipoNatureza::findOrFail($id);

        if ($tipo_natureza->naturezas()->first()){
            return redirect(route('tipo_natureza.index'))
                            ->with(['error_mensage' => 'Tipo de Natureza não pode ser excluida. Tipo de Natureza vinculada a uma Natureza']);
        }

        $tipo_natureza->delete();

        return redirect(route('tipo_natureza.index'))->with(['mensagem' => 'Tipo de Natureza excluída com sucesso!']);
    }
}
