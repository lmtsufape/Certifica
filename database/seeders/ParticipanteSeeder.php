<?php

namespace Database\Seeders;

use App\Models\Participante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Participante::factory()->create([
            'titulo' => 'Palestra Inteligência Artificial', 'carga_horaria' => '3', 'atividade_id' => '1'
        ]);
        Participante::factory()->create([
            'titulo' => 'Palestra IA', 'carga_horaria' => '3', 'atividade_id' => '1'
        ]);
        Participante::factory()->create([
            'titulo' => 'Palestra Redes Neurais', 'carga_horaria' => '3', 'atividade_id' => '1'
        ]);
    }
}
