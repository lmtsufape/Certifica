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
        Natureza::factory()->create(['descricao' => 'Ensino']);
        Natureza::factory()->create(['descricao' => 'Extensão']);
        Natureza::factory()->create(['descricao' => 'Pesquisa']);

    }
}
