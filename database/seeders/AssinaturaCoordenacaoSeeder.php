<?php

namespace Database\Seeders;

use App\Models\AssinaturaCoordenacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssinaturaCoordenacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssinaturaCoordenacao::factory()->count(3)->create();
    }
}
