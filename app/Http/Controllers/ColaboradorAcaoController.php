<?php

namespace App\Http\Controllers;
use App\Models\Acao; 
use App\Models\Colaborador; 
use Illuminate\Http\Request;

class ColaboradorAcaoController extends Controller
{
    public function listarColaboradores($acaoId)
    {
        $acao = Acao::find($acaoId);
        $colaboradores = Colaborador::where('acao_id', $acaoId)->with('user')->get();
        
        return view('colaborador.list_colaboradores', compact('acao', 'colaboradores'));
    }
    //
}
