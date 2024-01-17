<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoExternaParticipante extends Model
{
    use HasFactory;

    protected $table = 'info_externa_participantes';

    protected $fillable = [
        'tipo',
        'disciplina',
        'orientador',
        'periodo_letivo',
        'area',
        'local_realizado',
        'titulo_projeto',
    ];

    public function participante(){
        return $this->belongsTo(Participante::class);
    }


}
