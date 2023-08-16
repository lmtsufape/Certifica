<?php

namespace App\Http\Controllers;

use App\Models\Natureza;
use App\Models\TipoNatureza;
use App\Http\Requests\StoreTipoNaturezaRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTipoNaturezaRequest;
use App\Validates\TipoNaturezaValidator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class TipoNaturezaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->perfil_id == 3)
        {
            $tipo_naturezas = Natureza::join('tipo_naturezas', 'naturezas.id', '=', 'tipo_naturezas.natureza_id')->
                where('unidade_administrativa_id', Auth::user()->unidade_administrativa_id)->get();
        } else
        {
            $tipo_naturezas = TipoNatureza::all()->sortBy('id');
        }

        return view('tipo_natureza.tipo_natureza_consult', compact('tipo_naturezas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->perfil_id == 3)
        {
            $natureza = Natureza::where('unidade_administrativa_id', Auth::user()->unidade_administrativa_id)->first();

            return view('tipo_natureza.tipo_natureza_create', compact('natureza'));
        } else
        {
            $naturezas = Natureza::all()->sortBy('id');

            return view('tipo_natureza.tipo_natureza_create', compact('naturezas'));
        }

        return view('tipo_natureza.tipo_natureza_create', compact('naturezas'));
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
        $tipo_naturezas = TipoNatureza::all()->sortBy('id');

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
        $tipo_natureza = TipoNatureza::findOrFail($id);

        $natureza = Natureza::findOrFail($tipo_natureza->natureza_id);
        $naturezas = Natureza::all()->sortBy('id');

        return view('tipo_natureza.tipo_natureza_edit', compact('tipo_natureza', 'natureza', 'naturezas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoNaturezaRequest  $request
     * @param  \App\Models\TipoNatureza  $tipoNatureza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            TipoNaturezaValidator::validate($request->all());
        } catch (ValidationException $exception){
            return redirect(route('tipo_natureza.edit', ['id'=>$id]))->withErrors($exception->validator)->withInput();
        }

        $tipo_natureza = TipoNatureza::findOrFail($request->id);

        $tipo_natureza->update([
            'descricao' => $request->descricao,
            'natureza_id' => $request->natureza_id
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

        $tipo_natureza->delete();

        return redirect(route('tipo_natureza.index'))->with(['mensagem' => 'Tipo de Natureza excluída com sucesso!']);
    }
}
