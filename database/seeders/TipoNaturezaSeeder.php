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
        TipoNatureza::factory()->count(3)->create();
    }
}
