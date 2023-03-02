<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participante>
 */
class ParticipanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => '',
            'email' => '',
            'cpf' => '',
            'titulo' => '',
            'carga_horaria' => '',
            'atividade_id' => '',
        ];
    }
}
