<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificado;
use App\Models\Natureza;
use App\Models\UnidadeAdministrativa;
use App\Models\TipoNatureza;
use App\Models\Acao;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class RelatorioController extends Controller
{
    public function index(){
        $naturezas = Natureza::all();
        $tipos_natureza = TipoNatureza::orderBy('descricao')->get();
        $ano = 2019;
        $anos = [];

        do{
            $ano += 1;
            array_push($anos, $ano);
        } while($ano != Carbon::now()->year);

        return view('relatorios.index', compact('naturezas', 'tipos_natureza', 'anos'));
    }

    public function filtro(){
        $perfil_id = Auth::user()->perfil_id;
        $unidade = Auth::user()->unidade_administrativa_id;
        
        if($perfil_id == 1){
    
            $certificados = Certificado::all();
            $acoes = Acao::where('status', 'Aprovada');
            
        } else if($perfil_id == 3 && $unidade){
            
            $certificados = $this->get_certificados_by_unidade();   
            $acoes = Acao::where('unidade_administrativa_id', $unidade)
                         ->where('status', 'Aprovada');   
        }

        if(request('buscar_acao')){
            $certificados = Certificado::search_acao($certificados, request('buscar_acao'));
            $acoes = Acao::search_acao_by_name($acoes, request('buscar_acao'));
        }

        $acoes = $acoes->get();

        if(request('natureza')){
            $certificados = Certificado::search_natureza($certificados, request('natureza'));
            $acoes = Acao::search_acao_by_natureza($acoes, request('natureza'));
        }

        if(request('tipo_natureza')){
            $certificados = Certificado::search_tipo_natureza($certificados, request('tipo_natureza'));
            $acoes = Acao::search_acao_by_tipo_natureza($acoes, request('tipo_natureza'));
        }

        if(request('atividade')){
            $certificados = Certificado::search_atividade($certificados, request('atividade'));
        }

        if(request('ano')){
            $certificados = Certificado::search_ano($certificados, request('ano'));
            $acoes = Acao::search_acao_by_ano($acoes, request('ano'));
        }


        $acoes->each(function($acao){
            $acao->nome_atividades = "";
            $acao->atividades->each(function($atividade) use ($acao){
                $acao->total += $atividade->participantes()->count();
                $acao->nome_atividades = $acao->nome_atividades ? $acao->nome_atividades.", ".$atividade->descricao : $atividade->descricao;
            });
        });

        
        $total = count($certificados);

        return view('relatorios.list', compact('certificados', 'total', 'acoes')); 
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
