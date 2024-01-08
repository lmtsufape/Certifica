<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colaborador;

class ColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Colaborador::create([
            'gestor_id' => 3, // Substitua pelo ID do gestor desejado
            'acao_id' => 3,   // Substitua pelo ID da ação desejada
            'user_id' => 4,   // Substitua pelo ID do usuário desejado
        ]);


    }
}