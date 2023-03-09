<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['name' => 'Administrador', 'email' => 'admin@admin.teste', 'email_verified_at' => now(),
            'password' => Hash::make('password'), 'perfil_id' => '1']);

        User::factory()->create(['name' => 'Coordenador', 'email' => 'coordenador@admin.teste', 'email_verified_at' => now(),
                                'password' => Hash::make('password'), 'perfil_id' => '2',
                                'unidade_administrativa_id' => '1']);
        User::factory()->create(['name' => 'Gestor Institucional', 'email' => 'gestorinst@admin.teste', 'email_verified_at' => now(),
                                'password' => Hash::make('password'), 'perfil_id' => '3',
                                'unidade_administrativa_id' => '1']);
    }
}
