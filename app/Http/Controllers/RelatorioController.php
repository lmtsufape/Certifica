<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\TipoAtividade;
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

        $perfil_id = Auth::user()->perfil_id;
        $unidade = Auth::user()->unidade_administrativa_id;

        if($perfil_id == 1){

            $certificados = Certificado::all();
            $acoes = Acao::where('status', 'Aprovada')->get();

        } else if($perfil_id == 3 && $unidade){

            $certificados = $this->get_certificados_by_unidade();
            $acoes = Acao::where('unidade_administrativa_id', $unidade)
                ->where('status', 'Aprovada')->get();
        }

        do{
            $ano += 1;
            array_push($anos, $ano);
        } while($ano != Carbon::now()->year);

        $acoes->each(function($acao){
            $acao->nome_atividades = "";
            $acao->atividades->each(function($atividade) use ($acao){
                $acao->total += $atividade->participantes()->count();
                $acao->nome_atividades = $acao->nome_atividades ? $acao->nome_atividades.", ".$atividade->descricao : $atividade->descricao;
            });
        });


        $total = count($certificados);

        return view('relatorios.index', compact('naturezas', 'tipos_natureza', 'anos', 'acoes', 'total', 'certificados'));
    }

    public function filtro(){
        $perfil_id = Auth::user()->perfil_id;
        $unidade = Auth::user()->unidade_administrativa_id;

        if($perfil_id == 1){

            $certificados = Certificado::all();
            $acoes = Acao::where('status', 'Aprovada')->get();

        } else if($perfil_id == 3 && $unidade){

            $certificados = $this->get_certificados_by_unidade();
            $acoes = Acao::where('unidade_administrativa_id', $unidade)
                         ->where('status', 'Aprovada')->get();

        }

        if(request('buscar_acao')){
            $certificados = Certificado::search_acao($certificados, request('buscar_acao'));
            $acoes = Acao::search_acao_by_name($acoes, request('buscar_acao'));

        }

        if(request('natureza')){
            $certificados = Certificado::search_natureza($certificados, request('natureza'));
            $acoes = Acao::search_acao_by_natureza($acoes, request('natureza'));
        }

        if(request('tipo_natureza')){
            $certificados = Certificado::search_tipo_natureza($certificados, request('tipo_natureza'));
            $acoes = Acao::search_acao_by_tipo_natureza($acoes, request('tipo_natureza'));
        }

//        if(request('atividade')){
//            $certificados = Certificado::search_atividade($certificados, request('atividade'));
//        }

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

    public function atividades($acao_id){
        $acao = Acao::find($acao_id);
        $atividades = $acao->atividades()->get();



        $atividades->each(function($atividade) {
            $atividade->total = count($atividade->certificados);
            $atividade->participantes->each( function ($participante) use ($atividade){
                $atividade->nome_participantes = !$atividade->nome_participantes ? $participante->user->firstName()
                    : $atividade->nome_participantes.", ".$participante->user->firstName();
                $atividade->lista_nomes = $atividade->participantes->map(function ($participante) {
                    return $participante->user->name; // Supondo que exista um método fullName() para obter o nome completo do usuário.
                })->implode(", \n");
            });

        });


        $descricoes = ['Avaliador(a)', 'Bolsista', 'Colaborador(a)', 'Comissão Organizadora', 'Conferencista', 'Coordenador(a)', 'Formador(a)', 'Ministrante', 'Orientador(a)',
            'Palestrante', 'Voluntário(a)', 'Participante', 'Vice-coordenador(a)', 'Ouvinte', 'Apresentação de Trabalho'];

        $tipoAtividade = TipoAtividade::all();


        return view('relatorios.atividades', compact('acao', 'atividades', 'descricoes', 'tipoAtividade'));
    }

    public function atividades_filtro($acao_id){
        $acao = Acao::find($acao_id);

        $atividades = $acao->atividades()->get();


        if(request('descricao')){

            $atividades = Atividade::search_atividade_by_descricao($atividades, request('descricao'));

        }

//        if(request('data')){
//            $atividades = Atividade::search_atividade_by_data($atividades, request('data'));
//        }
//
//        if(request('buscar_participante')){
//            $atividades = Atividade::search_atividade_by_participante($atividades, request('buscar_participante'));
//        }



        $atividades->each(function($atividade) {
            $atividade->total = count($atividade->certificados);
            $atividade->participantes->each( function ($participante) use ($atividade){
                $atividade->nome_participantes = !$atividade->nome_participantes ? $participante->user->firstName()
                    : $atividade->nome_participantes.", ".$participante->user->firstName();
                $atividade->lista_nomes = $atividade->participantes->map(function ($participante) {
                    return $participante->user->name; // Supondo que exista um método fullName() para obter o nome completo do usuário.
                })->implode(", \n");
            });

        });




        return view('relatorios.atividades_list', compact('atividades', 'acao'));
    }

}
