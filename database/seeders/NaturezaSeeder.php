<?php

namespace Database\Seeders;

use App\Models\Natureza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NaturezaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Natureza::factory()->create(['descricao' => 'Projeto de ensino', 'tipo_natureza_id' => '1',
                                    'unidade_administrativa_id' => '1']);
        Natureza::factory()->create(['descricao' => 'Projeto de extensão', 'tipo_natureza_id' => '1',
                                    'unidade_administrativa_id' => '1']);
        Natureza::factory()->create(['descricao' => 'Projeto de pesquisa', 'tipo_natureza_id' => '1',
                                    'unidade_administrativa_id' => '1']);
    }
}
