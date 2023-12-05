<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTipoAtividade;
use App\Models\TipoAtividade;

class TipoAtividadeController extends Controller
{
    public function index(){

        $tiposAtividades = TipoAtividade::all();

        return view('tipo_atividade.index',compact('tiposAtividades'));
    }
    public function create(){
        return view('tipo_atividade.create');
    }
    public function store(StoreTipoAtividade $request){

        $validation = $request->validated();

        try {
            $tipoAtividade = new TipoAtividade;
            $tipoAtividade->create($request->all());

            return redirect(Route('tipoatividade.index'))->with(['mensagem' => 'Tipo de Atividade cadastrada com sucesso!']);
        } catch (\Throwable $e) {
            
        }
       
    }
    public function edit(){
        return view('tipo_atividade.edit');
    }
    public function update(){
        dd('update method');
    }
    public function destroy(){
        dd('delete method');
    }
}
