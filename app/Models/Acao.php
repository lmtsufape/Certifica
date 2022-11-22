<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acao extends Model
{
    use HasFactory;

    protected $table = 'acaos';

    protected $fillable = ['natureza_id', 'usuario_id', 'status',
     'titulo', 'data_inicio', 'data_fim'];
}
