<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participante extends Model
{
    use HasFactory;

    protected $table = 'participantes';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'titulo',
        'carga_horaria',
        'atividade_id'
    ];

    public static $rules = [
        'nome'          => 'required|min:10',
        'email'         => 'required|email',
        'cpf'           => 'required|min:11|max:11',
        'titulo'        => 'required',
        'carga_horaria' => 'required',
        'atividade_id'  => 'required',
    ];

    public static $editRules = [
        'nome'          => 'required|min:10',
        'email'         => 'required|email',
        'cpf'           => 'required|min:11|max:11',
        'titulo'        => 'required',
        'carga_horaria' => 'required',
        'atividade_id'  => 'required',
    ];

    public static $messages = [
        'nome.*'        => 'O nome do participante é obrigatório e deve ter no mínimo 10 caractéres',
        'email.*'       => 'O e-mail é obrigatório e deve ser um endereço de e-mail válido',
        'cpf.min'       => 'O CPF é obrigatório e deve ser um número de CPF válido',
        'titulo'        => 'O título é obrigatório',
        'carga_horaria' => 'A carga horária é obrigatória',
    ];
}
