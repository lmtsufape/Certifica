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
        $this->call([
            InstituicaoSeeder::class,
            CursoSeeder::class,
            UnidadeAdministrativaSeeder::class,
            PerfilSeeder::class,
            UserSeeder::class,
            NaturezaSeeder::class,
            TipoNaturezaSeeder::class,
            AcaoSeeder::class,
            AtividadeSeeder::class,
            ParticipanteSeeder::class
        ]);
    }
}
