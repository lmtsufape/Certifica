<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atividade extends Model
{
    use HasFactory;

    protected $table = 'atividades';

    protected $fillable = [
        'descricao',
        'data_inicio',
        'data_fim',
        'acao_id'
    ];

    public static $rules = [
        'descricao' => 'required|min:5',
        'data_inicio' => 'required|date|before_or_equal:data_fim',
        'data_fim' => 'required|date|after_or_equal:data_inicio',
        'acao_id' => 'required',
    ];

    public static $mensages = [
        'descricao.*'                   => 'A descrição deve possuir pelo menos 5 caracteres',
        'data_inicio.required'          => 'A data de início é obrigatória',
        'data_inicio.date'              => 'A data de início deve estar no formato data',
        'data_inicio.before_or_equal'   => 'A data de início deve ser anterior a data de fim',
        'data_fim.required'             => 'A data de término é obrigatória',
        'data_fim.date'                 => 'A data de término deve estar no formato data',
        'data_fim.after_or_equal'       => 'A data de término deve ser posterior a data de início',
        'acao_id'                       => 'A atividade deve estar vinculada a uma ação',
    ];

    public function acao(){
        return $this->belongsTo('App\Models\Acao');
    }

    public function participantes(){
        return $this->hasMany(Participante::class);
    }

    public function certificados(){
        return $this->hasMany(Certificado::class);
    }

    public function trabalhos(){
        return $this->hasMany('App\Models\Trabalho');
    }

    public function get_participantes_name(){
        $this->trabalhos->each(function ($trabalho) {
            $trabalho->autores->each( function ($participante) use ($trabalho){
                $trabalho->nome_participantes = !$trabalho->nome_participantes ? $participante->user->firstName()
                    : $trabalho->nome_participantes.", ".$participante->user->firstName();
                $trabalho->lista_nomes = $trabalho->autores->map(function ($participante) {
                    return $participante->user->name;
                })->implode(", \n");
            } );
            $trabalho->coautores->each( function ($participante) use ($trabalho){
                $trabalho->nome_participantes = !$trabalho->nome_participantes ? $participante->user->firstName()
                    : $trabalho->nome_participantes.", ".$participante->user->firstName();
                $trabalho->lista_nomes = $trabalho->coautores->map(function ($participante) {
                    return $participante->user->name;
                })->implode(", \n");
            } );
        });


    }

}
