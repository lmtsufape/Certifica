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
        Participante::factory()->create(['nome' => 'Douglas Filipe', 'email' => 'douglas@teste.com', 'cpf' => '23171780003',
                                        'titulo' => 'Palestra Inteligência Artificial', 'carga_horaria' => '3', 'atividade_id' => '1']);
        Participante::factory()->create(['nome' => 'Luiz Gustavo', 'email' => 'luiz@teste.com', 'cpf' => '21269842064',
                                        'titulo' => 'Palestra IA', 'carga_horaria' => '3','atividade_id' => '1']);
        Participante::factory()->create(['nome' => 'Ana Paula', 'email' => 'ana@teste.com', 'cpf' => '56488699083',
                                        'titulo' => 'Palestra Redes Neurais', 'carga_horaria' => '3','atividade_id' => '1']);
    }
}
