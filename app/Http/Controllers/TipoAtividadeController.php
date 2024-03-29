<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTipoAtividade;
use App\Http\Requests\UpdateTipoAtividade;
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
    public function edit($tipoAtividade_id){
        $tipoAtividade = TipoAtividade::findOrFail($tipoAtividade_id);

        return view('tipo_atividade.edit',compact('tipoAtividade'));
      
    }
    public function update(UpdateTipoAtividade $request){

        $validation = $request->validated();

        try {   
            $tipoAtividade = TipoAtividade::findOrFail($request->tipoAtividade_id);
            $tipoAtividade->update($request->all());

            return redirect(Route('tipoatividade.index'))->with(['mensagem' => 'Tipo de Atividade atualizada com sucesso!']);
        } catch (\Throwable $e){
            
        }
        
        
    }
    public function destroy($tipoatividade_id){

        $tipoAtividade = TipoAtividade::findOrFail($tipoatividade_id);
        $tipoAtividade->delete();

        return redirect(Route('tipoatividade.index'))->with(['mensagem' => 'Tipo de Atividade excluida com sucesso!']);
    }
}
