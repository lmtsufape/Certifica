<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabalho extends Model
{
    use HasFactory;

    protected $table = 'trabalhos';

    protected $fillable = [
        'titulo',
        'carga_horaria',
        'atividade_id'
    ];

    public static $rules = [
        'titulo' => 'required|min:5',
        'atividade_id' => 'required',
        'carga_horaria' => 'required|numeric',

    ];

    public static $editRules = [
        'carga_horaria' => 'required|numeric',
        'atividade_id' => 'required',
    ];

    public static $mensages = [
        'titulo.*'                   => 'O titulo do trabalho deve possuir pelo menos 5 caracteres',
        'atividade_id'               => 'O trabalho deve estar vinculado a uma atividade',
        'carga_horaria.required' => 'A carga horária é obrigatória',
        'carga_horaria.numeric' => 'A carga horária deve ser um numero',
    ];

    public function atividade(){
        return $this->belongsTo(Atividade::class);
    }

    public function autores() {
        return $this->hasMany(Participante::class, 'autor_trabalhos_id');
    }

    public function coautores() {
        return $this->hasMany(Participante::class, 'coautor_trabalhos_id');
    }

    // Dentro da classe Trabalho
    public function nomesAutoresComoTexto()
    {
        $nomes = '';

        // Verifica se existem autores associados a este trabalho
        if ($this->autores->isNotEmpty()) {
            foreach ($this->autores as $key => $autor) {
                $nomes .= $autor->user->name;

                // Adiciona uma vírgula entre os nomes, exceto para o último nome
                if ($key !== $this->autores->count() - 1) {
                    $nomes .= ', ';
                }
            }
        }

        return $nomes;
    }

    public function nomesCoautoresComoTexto()
    {
        $nomes = '';

        // Verifica se existem autores associados a este trabalho
        if ($this->coautores->isNotEmpty()) {
            foreach ($this->coautores as $key => $coautor) {
                $nomes .= $coautor->user->name;

                // Adiciona uma vírgula entre os nomes, exceto para o último nome
                if ($key !== $this->coautores->count() - 1) {
                    $nomes .= ', ';
                }
            }
        }

        return $nomes;
    }


}
