<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acao extends Model
{
    use HasFactory;

    protected $table = 'acaos';

    protected $fillable = ['titulo', 'data_inicio', 'data_fim', 'natureza_id', 'usuario_id', 'unidade_administrativa_id'];
}
