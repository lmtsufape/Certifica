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
        Natureza::factory()->create(['descricao' => 'Ensino', 'tipo_natureza_id' => '1',
                                    'unidade_administrativa_id' => '1']);
        Natureza::factory()->create(['descricao' => 'Extensão', 'tipo_natureza_id' => '1',
                                    'unidade_administrativa_id' => '1']);
        Natureza::factory()->create(['descricao' => 'Pesquisa', 'tipo_natureza_id' => '1',
                                    'unidade_administrativa_id' => '1']);
    }
}
