<?php

namespace App\Http\Controllers;
use App\Models\Acao; 
use App\Models\Colaborador; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ColaboradorAcaoController extends Controller
{

    public function createColaborador($acao_id, Request $request)
{
    $option = $request->input('cpf_pass');
    $cpf = $request->input('cpf');
    $passaporte = $request->input('passaporte');
    
    
    $user = $cpf ? User::where('cpf', $cpf)->first() : User::where('passaporte', $passaporte)->first();
    if (!$user) {
        return redirect()->route('listar.colaboradores', ['acaoId' => $acao_id])
            ->with('error', 'Usuário não encontrado. Por favor, verifique o CPF ou Passaporte.');
    }
    return view('colaborador.colaborador_create', [
        'acao' => Acao::find($acao_id),
        'user' => $user,
        'option' => $option,
    ]);
}

public function store($acao_id, $user_id)
{
    $colaborador = new Colaborador();
    $colaborador->acao_id = $acao_id;
    $colaborador->user_id = $user_id;
    $colaborador->gestor_id = auth()->user()->id;
    $colaborador->save();

    return redirect()->route('listar.colaboradores', ['acaoId' => $acao_id])
        ->with('success', 'Colaborador cadastrado com sucesso!');
}

    public function listarColaboradores($acaoId)
    {
        $acao = Acao::find($acaoId);
        $colaboradores = Colaborador::where('acao_id', $acaoId)->with('user')->get();
        
        return view('colaborador.list_colaboradores', compact('acao', 'colaboradores'));
    }

    public function removerColaborador(Acao $acao, Colaborador $colaborador)
    {
   
        $colaborador->delete();
        return redirect()->route('listar.colaboradores', ['acaoId' => $acao->id])
        ->with('success', 'Colaborador removido com sucesso.');
    }

    public function listarColaboracoesPorUsuario()
    {
    $userId = Auth::id();

    $user = User::find($userId);

    $colaboracoes = Colaborador::where('user_id', $userId)
        ->with('acao') 
        ->get();
        

    return view('colaborador.index_colaborador', compact('user', 'colaboracoes'));
    }

}
