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
        'titulo_plano',
        'orientador_cpf',
        'orientador_email',
        'data_inicio',
        'data_fim',
        'tipo_natureza_participante',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];

    public function participante(){
        return $this->hasOne(Participante::class, 'info_externa_participante_id');
    }

}
