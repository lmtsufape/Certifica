<?php

namespace App\Http\Controllers;

use App\Models\Natureza;
use App\Models\TipoNatureza;
use App\Models\UnidadeAdministrativa;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNaturezaRequest;
use App\Http\Requests\UpdateNaturezaRequest;
use App\Validates\NaturezaValidator;
use Illuminate\Validation\ValidationException;

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

        return view('natureza.natureza_index', compact('naturezas'));
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
        try {
            NaturezaValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('natureza.create'))->withErrors($exception->validator)->withInput();
        }

        Natureza::create($request->all());

        return redirect(route('natureza.index'))->with(['mensagem' => 'Natureza cadastrada com sucesso!']);
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

        return view('natureza.natureza_edit', compact('natureza'));
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

        if ($natureza->tipo_naturezas()->first()){
            return redirect(route('natureza.index'))
                ->with(['error_mensage' => 'Tipo de Natureza não pode ser excluida. Tipo de Natureza vinculada a uma Natureza']);
        }

        $natureza->delete();

        return redirect(Route('natureza.index'))->with(['mensagem' => 'Natureza excluída com sucesso!']);
    }
}
