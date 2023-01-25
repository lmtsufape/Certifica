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
        'status',
        'descricao',
        'info',
        'data_inicio',
        'data_fim',
        'carga_horaria',
        'acao_id'
    ];

    public static $rules = [
        'status' => 'required',
        'descricao' => 'required|min:5',
        'info' => 'required|min:10',
        'data_inicio' => 'required|date',
        'data_fim' => 'required|date',
        'carga_horaria' => 'required',
        'acao_id' => 'required',
    ];

}
