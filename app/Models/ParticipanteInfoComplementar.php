<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParticipanteInfoComplementar extends Model
{
    use SoftDeletes;

    protected $table = 'participante_info_complementars';
    
    protected $fillable = ['curso', 'orientador', 'local', 'carga_horaria', 'dia_inicio', 'dia_fim', 'participante_id'];
}
