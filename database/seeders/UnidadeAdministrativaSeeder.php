<?php

namespace Database\Seeders;

use App\Models\UnidadeAdministrativa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadeAdministrativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnidadeAdministrativa::factory()->create(['descricao' => 'BCC']);
        UnidadeAdministrativa::factory()->create(['descricao' => 'Letras']);
        UnidadeAdministrativa::factory()->create(['descricao' => 'Pedagogia']);
    }
}
