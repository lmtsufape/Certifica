<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssinaturaCoordenacao>
 */
class AssinaturaCoordenacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cargo' => $this->faker->text(15),
            'nome' => $this->faker->name(),
            'img_assinatura' => $this->faker->text(),
            'unidade_administrativa_id' => rand(1, 3),
        ];
    }
}
