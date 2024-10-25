<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Models\TipoAtividade;
use App\Models\Atividade;
use App\Models\Participante;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAtividadeRequest;
use App\Http\Requests\UpdateAtividadeRequest;
use App\Validates\AtividadeValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($acao_id)
{
    $acao = Acao::find($acao_id);
    $acao->get_participantes_name();

    $atividades = $acao->atividades->sortBy('id');

    $descricoes = [
        'Avaliador(a)', 'Bolsista', 'Colaborador(a)', 'Comissão Organizadora', 'Conferencista', 'Coordenador(a)',
        'Formador(a)', 'Ministrante', 'Orientador(a)', 'Palestrante', 'Voluntário(a)', 'Participante', 
        'Vice-coordenador(a)', 'Ouvinte', 'Apresentação de Trabalho'
    ];

    $tipoAtividade = TipoAtividade::all();
    $tipoAtividadeName = $tipoAtividade->pluck('name')->toArray();
    $tipos_ordenados = array_merge($tipoAtividadeName, $descricoes);
    sort($tipos_ordenados);

    return view('atividade.atividade_index', [
        'atividades' => $atividades,
        'acao' => $acao,
        'tipos_ordenados' => $tipos_ordenados
    ]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);
        $descricoes = ['Avaliador(a)', 'Bolsista', 'Colaborador(a)', 'Comissão Organizadora', 'Conferencista', 'Coordenador(a)', 'Formador(a)', 'Ministrante', 'Orientador(a)',
                        'Palestrante', 'Voluntário(a)', 'Participante', 'Vice-coordenador(a)', 'Ouvinte', 'Apresentação de Trabalho'];

        $tipoAtividade = TipoAtividade::where('unidade_administrativa_id', $acao->unidade_administrativa_id)->get();

        $tipoAtividadeName = $tipoAtividade->pluck('name')->toArray();
        $tipos_ordenados = array_merge($tipoAtividadeName, $descricoes);
        sort($tipos_ordenados);


        return view('atividade.atividade_create',compact('acao','tipos_ordenados'));
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAtividadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            AtividadeValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('atividade.create', ['acao_id' => $request->acao_id]))->withErrors($exception->validator)->withInput();;
        }

        $acao = Acao::findOrFail($request->acao_id);

        if($request->descricao == 'Outra')
        {
            $atividade = new Atividade();

            $atividade->descricao = $request->outra;
            $atividade->data_inicio = $request->data_inicio;
            $atividade->data_fim = $request->data_fim;
            $atividade->acao_id = $request->acao_id;

            $atividade->save();

        } else
        {
            Atividade::create($request->all());
        }

        if(Auth::user()->perfil_id == 3 && $acao->usuario_id != Auth::user()->id)
        {
            return redirect(route('gestor.analisar_acao', ['acao_id' => $request->acao_id]))->with(['mensagem' => "Atividade cadastrada com sucesso."]);
        }
        else
        {
            return redirect(route('atividade.index', ['acao_id' => $request->acao_id]))->with(['mensagem' => "Atividade cadastrada com sucesso."]);
        }

    }

    public function requisicao(Request $request)
    {
        try {
            AtividadeValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('atividade.create', ['acao_id' => $request->acao_id]))->withErrors($exception->validator)->withInput();;
        }


            $atividade = new Atividade();

            $atividade->descricao = $request->descricao;
            $atividade->data_inicio = $request->data_inicio;
            $atividade->data_fim = $request->data_fim;
            $atividade->acao_id = $request->acao_id;

            $atividade->save();



        return response(['atividade' => $atividade]);
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
    public function edit($atividade_id)
    {
        $atividade = Atividade::findOrFail($atividade_id);

        $acao = Acao::findOrFail($atividade->acao_id);

        $tipoAtividade = TipoAtividade::all();

        $descricoes = ['Avaliador(a)', 'Bolsista', 'Colaborador(a)', 'Comissão Organizadora', 'Conferencista', 'Coordenador(a)', 'Formador(a)', 'Ministrante', 'Orientador(a)',
            'Palestrante', 'Voluntário(a)', 'Participante', 'Vice-coordenador(a)', 'Ouvinte', "Apresentação de Trabalho"];

        $tipoAtividadeName = $tipoAtividade->pluck('name')->toArray();
        $tipos_ordenados = array_merge($tipoAtividadeName, $descricoes);
        sort($tipos_ordenados);

        return view('atividade.atividade_edit', compact('atividade', 'acao', 'tipos_ordenados'));
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
        try {
            AtividadeValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('atividade.edit', ['atividade_id' => $request->id]))
                            ->withErrors($exception->validator)->withInput();
        }


        $atividade = Atividade::findOrFail($request->id);

        //$atividade->status = $request->status;
        $atividade->descricao = $request->descricao;
        $atividade->data_inicio = $request->data_inicio;
        $atividade->data_fim = $request->data_fim;
        $atividade->acao_id = $request->acao_id;

        $atividade->update();

        return redirect(Route('atividade.index', ['acao_id' => $request->acao_id]))
                                ->with(['mensagem'=>'Atividade editada com sucesso']);
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

        $atividade->participantes()->delete();
        $atividade->trabalhos()->delete();

        $atividade->delete();


        return redirect(Route('atividade.index', ['acao_id' => $atividade->acao_id]))
                                ->with(['mensagem' => 'Atividade excluida com sucesso']);
    }
}
