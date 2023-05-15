<?php

namespace Database\Seeders;

use App\Models\TipoNatureza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoNaturezaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Tipos de natureza para Ensino
        TipoNatureza::factory()->create(['descricao' => 'projeto', 'natureza_id' => '1']);

        //Tipos de natureza para Extensão
        TipoNatureza::factory()->create(['descricao' => 'projeto no Programa PIBEX', 'natureza_id' => '2']);
        TipoNatureza::factory()->create(['descricao' => 'projeto no Programa de Fluxo Contínuo', 'natureza_id' => '2']);
        TipoNatureza::factory()->create(['descricao' => 'curso no Programa de Fluxo Contínuo', 'natureza_id' => '2']);
        TipoNatureza::factory()->create(['descricao' => 'evento no Programa de Fluxo Contínuo', 'natureza_id' => '2']);
        TipoNatureza::factory()->create(['descricao' => 'prestação de serviço no Programa de Fluxo Contínuo', 'natureza_id' => '2']);

        //Tipos de natureza para Pesquisa
        TipoNatureza::factory()->create(['descricao' => 'projeto no edital PIBIC', 'natureza_id' => '3']);
        TipoNatureza::factory()->create(['descricao' => 'projeto no edital PIBIC-EM', 'natureza_id' => '3']);
        TipoNatureza::factory()->create(['descricao' => 'projeto no edital PIBIT', 'natureza_id' => '3']);
    }
}
