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
        'data_inicio' => 'required|date|before:data_fim',
        'data_fim' => 'required|date|after:data_inicio',
        'acao_id' => 'required',
    ];

    public static $mensages = [
        'descricao.*'           => 'A descrição deve possuir pelo menos 5 caracteres',
        'data_inicio.required'  => 'A data de inicio é obrigatória',
        'data_inicio.date'      => 'A data de inicio deve estar no formato data',
        'data_inicio.before'    => 'A data de inicio deve ser anterior a data de fim',
        'data_fim.required'     => 'A data de fim é obrigatória',
        'data_fim.date'         => 'A data de fim deve estar no formato data',
        'data_fim.after'        => 'A data de fim deve ser posterior a data de inicio',
        'acao_id'               => 'A atividade deve estar vinculada a uma ação',
    ];

    public function acao(){
        return $this->belongsTo('App\Models\Acao');
    }

}
