<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atividade>
 */
class AtividadeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status' => '',
            'descricao' => '',
            'info' => '',
            'data_inicio' => '',
            'data_fim' => '',
            'carga_horaria' => '',
            'acao_id' => '',
        ];
    }
}
