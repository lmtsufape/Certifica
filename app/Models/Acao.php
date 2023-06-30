<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acao extends Model
{
    use HasFactory;

    protected $table = 'acaos';

    protected $fillable = ['titulo', 'data_inicio', 'data_fim', 'natureza_id', 'usuario_id', 'anexo', 'unidade_administrativa_id'];

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


    //######################### FILTROS ############################//
    public static function search_acao_by_name($acoes, $nome_acao){
        return $acoes->where('titulo', 'ilike', '%'.$nome_acao.'%');
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

}
