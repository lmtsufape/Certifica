<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Natureza>
 */
class NaturezaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'descricao' => $this->faker->text(10),
            'tipo_natureza_id' => rand(1, 3),
            'unidade_administrativa_id' => rand(1, 3),
        ];
    }
}
