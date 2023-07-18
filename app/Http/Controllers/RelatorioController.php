<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificado;
use App\Models\Natureza;
use App\Models\UnidadeAdministrativa;
use Illuminate\Support\Facades\Auth;



class RelatorioController extends Controller
{
    public function index(){
        $naturezas = Natureza::all();

        return view('relatorios.index', compact('naturezas'));
    }

    public function filtro(){
        $perfil_id = Auth::user()->perfil_id;
        $unidade = Auth::user()->unidade_administrativa_id;
        
        if($perfil_id == 1){
    
            $certificados = Certificado::all();
    
        } else if($perfil_id == 3 && $unidade){
            
            $certificados = $this->get_certificados_by_unidade();            
    
        }

        if(request('buscar_acao')){
            $certificados = Certificado::search_acao($certificados, request('buscar_acao'));
        }


        if(request('natureza')){
            $certificados = Certificado::search_natureza($certificados, request('natureza'));
        }

        
        $total = count($certificados);

        return view('relatorios.list', compact('certificados', 'total')); 
    }

    private function get_certificados_by_unidade(){
        $id_unidade = Auth::user()->unidade_administrativa_id;

        $unidade = UnidadeAdministrativa::find($id_unidade);
        
        $certificados = collect();
        
        $unidade->acaos->each(function($acao) use ($certificados){
            $certificados->push($acao->certificados);
        });

        return $certificados->collapse();
    }
    
}
