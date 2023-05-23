<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Natureza;
use App\Models\SubmeterAcao;
use App\Models\TipoNatureza;
use App\Models\UnidadeAdministrativa;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAcaoRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Validates\AcaoValidator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;


class AcaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acaos = Acao::all()->where('usuario_id', Auth::user()->id)->sortBy('id');

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

        $naturezas_ensino = TipoNatureza::all()->where('natureza_id', 1);
        $naturezas_extensao = TipoNatureza::all()->where('natureza_id', 2);
        $naturezas_pesquisa = TipoNatureza::all()->where('natureza_id', 3);

        return view('acao.acao_create', compact('naturezas', 'naturezas_ensino', 'naturezas_extensao',
                                                    'naturezas_pesquisa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAcaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            AcaoValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('acao.create'))
                ->withErrors($exception->validator)->withInput();
        }

        if($request->natureza_id == 1)
        {
            $request->tipo_natureza_id = $request->ensino;
        } else if($request->natureza_id == 2)
        {
            $request->tipo_natureza_id = $request->extensao;
        } else if($request->natureza_id == 3)
        {
            $request->tipo_natureza_id = $request->pesquisa;
        }

        $acao = new Acao();

        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->tipo_natureza_id = $request->tipo_natureza_id;
        $acao->usuario_id = $request->usuario_id;

        $natureza = Natureza::find($request->natureza_id);

        $acao->unidade_administrativa_id = $natureza->unidade_administrativa_id;

        $acao->anexo = $request->file('anexo')->store('anexos');

        $acao->save();

        return redirect(Route('acao.index'))->with(['mensagem' => 'Ação cadastrada com sucesso']);
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
        $naturezas_ensino = TipoNatureza::all()->where('natureza_id', 1);
        $naturezas_extensao = TipoNatureza::all()->where('natureza_id', 2);
        $naturezas_pesquisa = TipoNatureza::all()->where('natureza_id', 3);

        $acao = Acao::findOrFail($id);
        $natureza = Natureza::findOrFail($acao->tipo_natureza->natureza_id);
        $tipo_natureza = TipoNatureza::findOrFail($acao->tipo_natureza_id);
        $naturezas = Natureza::all()->sortBy('id');


        return view('acao.acao_edit',compact('acao','naturezas', 'natureza',
        'naturezas_ensino','naturezas_extensao', 'naturezas_pesquisa','tipo_natureza'));
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
        try {
            AcaoValidator::validate($request->all());
        } catch (ValidationException $exception) {

            return redirect(route('acao.edit', ['acao_id' => $request->id]))->withErrors($exception->validator)->withInput();
        }

        if($request->natureza_id == 1)
        {
            $request->tipo_natureza_id = $request->ensino;
        } else if($request->natureza_id == 2)
        {
            $request->tipo_natureza_id = $request->extensao;
        } else if($request->natureza_id == 3)
        {
            $request->tipo_natureza_id = $request->pesquisa;
        }



        $acao = Acao::findOrFail($request->id);

        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->tipo_natureza_id = $request->tipo_natureza_id;
        $acao->usuario_id = $request->usuario_id;

        $natureza = Natureza::find($request->natureza_id);
        $acao->unidade_administrativa_id = $natureza->unidade_administrativa_id;

        $acao->update();

        return redirect(Route('acao.index'))->with(['mensagem' => 'Ação editada com sucesso']);
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

        if($acao->atividades()->first()){
            return redirect(route('acao.index'))->with(['error_mensage' => 'A ação não pode ser excluída.
                                                                Existe uma ou mais atividades vinculadas a ela.']);
        }

        $acao->delete();

        return redirect(Route('acao.index'))->with(['mensagem' => 'Ação excluída com sucesso']);
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

        if($request->action == 'reprovar')
        {
           $status = 'Reprovada';
        } else
        {
            $status = 'Aprovada';
        }

        $acao->status = $status;

        $acao->update();

        if($status == 'Aprovada')
        {
            return redirect(Route('gestor.gerar_certificados', ['acao_id' => $acao->id]));
        } else
        {
            return redirect(Route('gestor.acoes_submetidas'));
        }

    }

    public function dowload_anexo($id){
        $acao = Acao::findOrFail($id);
        return Storage::download($acao->anexo);
    }


}
