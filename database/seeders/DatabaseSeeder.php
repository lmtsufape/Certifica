<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UnidadeAdministrativa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UnidadeAdministrativaSeeder::class]);
        $this->call([PerfilSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([NaturezaSeeder::class]);
        $this->call([TipoNaturezaSeeder::class]);
        $this->call([AcaoSeeder::class]);
        $this->call([AtividadeSeeder::class]);
        $this->call([ParticipanteSeeder::class]);
    }
}
