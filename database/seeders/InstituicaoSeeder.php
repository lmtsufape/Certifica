<?php

namespace Database\Seeders;

use App\Models\Instituicao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instituicao::factory(1)->create(['nome' => 'Universidade Federal do Agreste de Pernambuco', 'sigla'=> 'UFAPE']);
        Instituicao::factory(1)->create(['nome' => 'Outras']);
    }
}
