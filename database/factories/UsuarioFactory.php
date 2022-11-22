<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => rand(10000000000, 99999999999),
            'telefone' => rand(10000000000, 99999999999),
            'email' => $this->faker->unique()->safeEmail(),
            'senha' => Hash::make('password'),
            'perfil_id' => rand(1, 3),
        ];
    }
}
