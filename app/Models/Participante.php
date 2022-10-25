<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participante extends Model
{
    use SoftDeletes;

    protected $table = 'participantes';
    
    protected $fillable = ['nome', 'email', 'cpf', 'ativo', 'chave_validacao', 'atividade_id'];
    
}
