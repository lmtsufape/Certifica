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
        UnidadeAdministrativa::factory()->create(['descricao' => 'PROAD - Pró-Reitoria de Administração']);
        UnidadeAdministrativa::factory()->create(['descricao' => 'PROPLAN - Pró-Reitoria de Planejamento']);
        UnidadeAdministrativa::factory()->create(['descricao' => 'PROGEPE - Pró-Reitoria de Gestão de Pessoas']);
        UnidadeAdministrativa::factory()->create(['descricao' => 'PRAE - Pró-Reitoria de Assistência Estudantil']);
        UnidadeAdministrativa::factory()->create(['descricao' => 'PREG - Pró-Reitoria de Ensino e Graduação']);
        UnidadeAdministrativa::factory()->create(['descricao' => 'PRPPGI - Pró-Reitoria de Pesquisa , Pós-Graduação e Inovação']);
        UnidadeAdministrativa::factory()->create(['descricao' => 'PREC - Pró-Reitoria de Extensão e Cultura']);
    }
}
