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
        'ativo',
        'atividade_id'
    ];

    public static $rules = [
        'nome' => 'required|min:5',
        'email' => 'required|email',
        'cpf' => 'required|min:11|max:11',
        'ativo' => 'required',
        'atividade_id' => 'require',
    ];

}
