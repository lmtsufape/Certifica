<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curso::factory(1)->create(['nome'=>'Bacharelado em Agronomia']);
        Curso::factory(1)->create(['nome'=>'Bacharelado em Ciência da Computação']);
        Curso::factory(1)->create(['nome'=>'Bacharelado em Engenharia de Alimentos']);
        Curso::factory(1)->create(['nome'=>'Bacharelado em Medicina Veterinária']);
        Curso::factory(1)->create(['nome'=>'Bacharelado em Zootecnia']);
        Curso::factory(1)->create(['nome'=>'Licenciatura em Letras']);
        Curso::factory(1)->create(['nome'=>'Licenciatura em Pedagogia']);
    }
}
