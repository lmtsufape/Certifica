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
        Natureza::factory()->create(['descricao' => 'Ensino', 'unidade_administrativa_id' => 1]);
        Natureza::factory()->create(['descricao' => 'Extensão', 'unidade_administrativa_id' => 2]);
        Natureza::factory()->create(['descricao' => 'Pesquisa', 'unidade_administrativa_id' => 3]);

    }
}
