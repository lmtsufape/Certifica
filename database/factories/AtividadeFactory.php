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
            'status' => rand(0, 1),
            'descricao' => $this->faker->text(20),
            'info' => $this->faker->text(20),
            'data_inicio' => '2022-10-10',
            'data_fim' => '2022-10-20',
            'carga_horaria' => rand(1, 999),
            'acao_id' => rand(1, 3),
        ];
    }
}
