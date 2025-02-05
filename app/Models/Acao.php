<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Acao extends Model
{
    use HasFactory;

    protected $table = 'acaos';

    protected $fillable = ['titulo', 'data_inicio', 'data_fim', 'natureza_id', 'usuario_id', 'anexo', 'unidade_administrativa_id', 'data_personalizada'];

    public static $rules = [
        'titulo'                    => 'required|string|min:10',
        'data_inicio'               => 'required|before_or_equal:data_fim',
        'data_fim'                  => 'required|after_or_equal:data_inicio',
        'natureza_id'               => 'required',
        'usuario_id'                => 'required',
        'anexo'                     => 'file'
    ];

    public static $messages = [
        'titulo.required'           => 'O título deve ser preenchido',
        'titulo.string'             => 'O título deve possuir apenas letras.',
        'titulo.min'                => 'O título deve ter 10 ou mais caracteres',
        'data_inicio.required'      => 'A data de início deve ser preenchida',
        'data_inicio.before'        => 'A data de início deve ser anterior a data de fim',
        'data_fim.required'         => 'A data de fim deve ser preenchida',
        'data_fim.after'            => 'A data de término deve ser posterior a data de início',
        'natureza_id'               => 'A natureza deve ser informada',
        'usuario_id'                => 'O usuário deve ser informado',
        'anexo'                     => 'O arquivo enviado deve ser no formato PDF',
        //'anexo.required'            => 'O envio do arquivo é obrigatório'

    ];

    public function tipo_natureza(){
        return $this->belongsTo(TipoNatureza::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function unidadeAdministrativa(){
        return $this->belongsTo(UnidadeAdministrativa::class);
    }

    public function atividades(){
        return $this->hasMany('App\Models\Atividade');
    }

    public function participantes(){
        $participantes = collect();

        $this->atividades->each(function($atividade)  use ($participantes)
        {
            $atividade->participantes->each(function($participante) use ($participantes)
            {
                $participantes->push($participante->user);
            });

        });

        return $participantes;
    }


    public function participantes_user($acao){
        $participantes = collect();

        $this->atividades->each(function($atividade)  use ($participantes)
        {
            if($atividade->emissao_parcial != true)
            {
                $atividade->participantes->each(function($participante) use ($participantes)
                {
                    $participantes->push($participante->user);
                });
            }
        });

        return $participantes;
    }
    public function atividade_participantes_user($acao)
    {
        $atividade_partipantes = collect();

        $this->atividades->each(function ($atividade) use ($atividade_partipantes) {
            if ($atividade->emissao_parcial !== true) {
                $participantes = $atividade->participantes->pluck('user');

                $atividade_partipantes->add([
                    'participantes' => $participantes,
                    'atividade' => $atividade->descricao,
                ]);
            }
        });

        return $atividade_partipantes;
    }




    public function certificados(){
        return $this->throughAtividades()->hasCertificados();
    }



    //######################### FILTROS ############################//
    public static function search_acao_by_name($acoes, $nome_acao){
        return Acao::where('titulo', 'ilike', '%'.$nome_acao.'%')->get();
    }

    public static function search_acao_by_status($acoes, $status){
        return $acoes->where('status', $status);
    }

    public static function search_acao_by_data($acoes, $data){
        return $acoes->where('data_inicio','<=',$data)->where('data_fim', '>=', $data);
    }


    public static function search_acao_by_natureza($acoes, $natureza_id){
        $natureza = Natureza::find($natureza_id);
        return $acoes->whereIn('tipo_natureza', $natureza->tipoNatureza);
    }

    public static function search_acao_by_tipo_natureza($acoes, $tipo_natureza_id){
        $tipoNatureza = TipoNatureza::find($tipo_natureza_id);
        return $acoes->where('tipo_natureza', $tipoNatureza);
    }

    public static function search_acao_by_ano($acoes, $ano){
        return Acao::where('unidade_administrativa_id', Auth::user()->unidade_administrativa_id)->where('status', 'Aprovada')
            ->where(function($query) {
                $query->whereYear('data_personalizada', request('ano'))->orWhere(function($query) {
                    $query->whereNull('data_personalizada')->whereYear('created_at', request('ano'));
                });
            })->get();
    }
    public function colaboradores()
    {
        return $this->hasMany(Colaborador::class);
    }

    //cria um campo em cada atividade com o nome dos participantes
    public function get_participantes_name(){
        $this->atividades->each(function ($atividade){
            if($atividade->descricao ==='Apresentação de Trabalho'){
                if($atividade->trabalhos){
                    $atividade->trabalhos->each(function ($trabalhos) use ($atividade) {
                        $trabalhos->autores->each(function ($participante) use ($atividade) {
                            // Adiciona os autores à lista de participantes da atividade
                            $atividade->nome_participantes = !$atividade->nome_participantes ? $participante->user->firstName()
                                : $atividade->nome_participantes . ", " . $participante->user->firstName();
                            $atividade->lista_nomes = $atividade->participantes->map(function ($participante) {
                                return $participante->user->name;
                            })->implode(", \n");
                        });

                        $trabalhos->coautores->each(function ($participante) use ($atividade) {
                            // Adiciona os coautores à lista de participantes da atividade
                            $atividade->nome_participantes = !$atividade->nome_participantes ? $participante->user->firstName()
                                : $atividade->nome_participantes . ", " . $participante->user->firstName();
                            $atividade->lista_nomes = $atividade->participantes->map(function ($participante) {
                                return $participante->user->name;
                            })->implode(", \n");
                        });
                    });

                }
            } else{
                $atividade->participantes->each( function ($participante) use ($atividade){
                    $atividade->nome_participantes = !$atividade->nome_participantes ? $participante->user->firstName()
                        : $atividade->nome_participantes.", ".$participante->user->firstName();
                    $atividade->lista_nomes = $atividade->participantes->map(function ($participante) {
                        return $participante->user->name; // Supondo que exista um método fullName() para obter o nome completo do usuário.
                    })->implode(", \n");
                });
            }

        });
    }
}
