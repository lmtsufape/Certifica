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
            'password' => Hash::make('password'), 'perfil_id' => '1', 'cpf' => '55772251597']);

        User::factory()->create(['name' => 'Coordenador', 'email' => 'coordenador@admin.teste', 'email_verified_at' => now(),
                                'password' => Hash::make('password'), 'perfil_id' => '2',
                                'unidade_administrativa_id' => '1', 'cpf' => '64645983415', 'celular' => '87999887766',
                                'instituicao' => 'UFAPE', 'siape' => '6543REDS']);
        User::factory()->create(['name' => 'Gestor Institucional', 'email' => 'gestorinst@admin.teste', 'email_verified_at' => now(),
                                'password' => Hash::make('password'), 'perfil_id' => '3',
                                'unidade_administrativa_id' => '1', 'cpf' => '78525571717']);
        User::factory()->create(['name' => 'PREC', 'email' => 'certificacao.prec@ufape.edu.br', 'email_verified_at' => now(),
            'password' => Hash::make('prec123'), 'perfil_id' => '3',
            'unidade_administrativa_id' => '1']);
    }
}
