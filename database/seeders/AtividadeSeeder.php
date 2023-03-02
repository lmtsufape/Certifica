<?php

namespace Database\Seeders;

use App\Models\Atividade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AtividadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Atividade::factory()->create(['status' => '0', 'descricao' => 'Palestra', 'info' => 'Palestra sobre Robótica',
                                    'data_inicio' => '2022-01-02', 'data_fim' => '2022-01-02', 'carga_horaria' => '5',
                                    'acao_id' => '1']);
    }
}
