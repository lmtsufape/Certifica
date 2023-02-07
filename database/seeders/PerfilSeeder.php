<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::factory()->create(['nome' => 'Administrador']);
        Perfil::factory()->create(['nome' => 'Coordenador']);
        Perfil::factory()->create(['nome' => 'Unidade Administrativa']);
        Perfil::factory()->create(['nome' => 'Participante']);
        Perfil::factory()->create(['nome' => 'Gestor Institucional']);
    }
}
