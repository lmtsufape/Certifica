<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Acao>
 */
class AcaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status' => $this->faker->boolean(),
            'titulo' => $this->faker->text(),
            'data_inicio' => '2022-10-10',
            'data_fim' => '2022-10-20',
            'natureza_id' => rand(1, 3),
            'usuario_id' => rand(1, 3),
        ];
    }
}
