<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Trabalho;
use App\Validates\TrabalhoValidator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TrabalhoController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($atividade_id)
    {
        $atividade = Atividade::find($atividade_id);

        $atividade->get_participantes_name();

        $trabalhos = $atividade->trabalhos->sortBy('id');
        $acao = Acao::findOrFail($atividade->acao_id);

        return view('trabalho.trabalho_index', ['trabalhos' => $trabalhos, 'atividade' => $atividade, 'acao' => $acao]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($atividade_id)
    {
        $atividade = Atividade::findOrFail($atividade_id);
        $acao = Acao::findOrFail($atividade->acao_id);


        return view('trabalho.trabalho_create',compact('acao','atividade'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTrabalhoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            TrabalhoValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('trabalho.create', ['atividade_id' => $request->atividade_id]))->withErrors($exception->validator)->withInput();;
        }


            Trabalho::create($request->all());



        return redirect(route('trabalho.index', ['atividade_id' => $request->atividade_id]))->with(['mensagem' => "Trabalho cadastrada com sucesso."]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trabalho  $trabalho
     * @return \Illuminate\Http\Response
     */
    public function edit($trabalho_id)
    {

        $trabalho = Trabalho::findOrFail($trabalho_id);
        $atividade = Atividade::findOrFail($trabalho->atividade_id);

        $acao = Acao::findOrFail($atividade->acao_id);





        return view('trabalho.trabalho_edit', compact('atividade', 'acao', 'trabalho'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrabalhoRequest  $request
     * @param  \App\Models\Trabalho  $trabalho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            TrabalhoValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('trabalho.edit', ['trabalho_id' => $request->id]))
                ->withErrors($exception->validator)->withInput();
        }


        $trabalho = Trabalho::findOrFail($request->id);


        $trabalho->titulo = $request->titulo;
        $trabalho->carga_horaria = $request->carga_horaria;
        $trabalho->atividade_id = $request->atividade_id;

        $this->updateAutoresCargaHoraria($trabalho, $request->carga_horaria);

        $trabalho->update();

        return redirect(Route('trabalho.index', ['atividade_id' => $request->atividade_id]))
            ->with(['mensagem'=>'Trabalho editado com sucesso']);
    }

    public function updateAutoresCargaHoraria(Trabalho $trabalho, $novaCargaHoraria)
    {
        $autores = $trabalho->autores;
        $coautores = $trabalho->coautores;

        // Atualiza a carga horária dos autores
        foreach ($autores as $participante) {
            $participante->carga_horaria = $novaCargaHoraria;
            $participante->save();
        }

        // Atualiza a carga horária dos coautores
        foreach ($coautores as $participante) {
            $participante->carga_horaria = $novaCargaHoraria;
            $participante->save();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trabalho  $trabalho
     * @return \Illuminate\Http\Response
     */
    public function delete($trabalho_id)
    {
        $trabalho = Trabalho::findOrFail($trabalho_id);

        $trabalho->autores()->delete();
        $trabalho->coautores()->delete();

        $trabalho->delete();


        return redirect(Route('trabalho.index', ['atividade_id' => $trabalho->atividade_id]))
            ->with(['mensagem' => 'Trabalho excluido com sucesso']);
    }


}
