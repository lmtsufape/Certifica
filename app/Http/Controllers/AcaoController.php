<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Natureza;
use App\Models\SubmeterAcao;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAcaoRequest;
use Illuminate\Support\Facades\Auth;

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
        $naturezas = Natureza::all()->sortBy('id');

        return view('acao.acao_create', ['naturezas' => $naturezas]);
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

        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->natureza_id = $request->natureza_id;
        $acao->usuario_id = $request->usuario_id;
        $acao->unidade_administrativa_id = $request->unidade_administrativa_id;


        $acao->save();

        return redirect(Route('acao.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function show($acao_id)
    {

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
        $natureza = Natureza::findOrFail($acao->natureza_id);
        $naturezas = Natureza::all()->sortBy('id');

        return view('acao.acao_edit', ['acao' => $acao, 'naturezas' => $naturezas, 'natureza' => $natureza]);
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

        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->natureza_id = $request->natureza_id;
        $acao->usuario_id = $request->usuario_id;
        $acao->unidade_administrativa_id = $request->unidade_administrativa_id;

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

    public function submeter_acao($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);

        $acao->status = 'Em análise';

        $acao->update();

        return redirect(Route('acao.index'));
    }

    public function acoes_submetidas()
    {
        $acaos = Acao::all()->where('status', '!=', null)->where
                ('unidade_administrativa_id', Auth::user()->unidade_administrativa_id)->sortBy('id');

        return view('gestor_institucional.acoes_submetidas', ['acaos' => $acaos]);
    }

    public function analisar_acao($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);
        $atividades = Atividade::all()->where('acao_id', $acao_id)->sortBy('id');

        return view('gestor_institucional.analisar_acao', ['acao' => $acao, 'atividades' => $atividades]);
    }

    public function acao_update(Request $request)
    {
        $acao = Acao::findOrFail($request->id);

        if($request->action == 'negar')
        {
           $status = 'Negada';
        } else
        {
            $status = 'Aprovada';
        }

        $acao->status = $status;

        $acao->update();

        return redirect(Route('gestor.acoes_submetidas'));
    }


}
