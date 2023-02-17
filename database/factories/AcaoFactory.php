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
            'titulo' => '',
            'data_inicio' => '',
            'data_fim' => '',
            'natureza_id' => '',
            'usuario_id' => '',
            'unidade_administrativa_id' => '',
        ];
    }
}
