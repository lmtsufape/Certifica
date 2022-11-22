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
        Natureza::factory()->count(3)->create();
    }
}
