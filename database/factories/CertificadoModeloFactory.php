<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CertificadoModelo>
 */
class CertificadoModeloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'assinatura_direita' => $this->faker->text(),
            'assinatura_esquerda' => $this->faker->text(),
            'texto_posicao' => rand(1, 3),
            'data_posicao' => rand(1, 3),
            'unidade_adiministrativa_id' => rand(1,3)
        ];
    }
}
