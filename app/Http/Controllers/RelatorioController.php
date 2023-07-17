<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificado;
use App\Models\Natureza;
use Illuminate\Support\Facades\Auth;



class RelatorioController extends Controller
{
    public function index(){
        $naturezas = Natureza::all();
        $certificados = Certificado::all();

        return view('relatorios.index', compact('naturezas'));
    }

    public function filtro(){
        $perfil_id = Auth::user()->perfil_id;
        $unidade = Auth::user()->unidade_administrativa;
        
        if($perfil_id == 1){
    
            $certificados = Certificado::all();
    
        } else if($perfil_id == 3 && $unidade){
            // $certificado->atividade->unidade_administrativa;
            // $certificados = Certificado::where(, $unidade);
    
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
    
}
