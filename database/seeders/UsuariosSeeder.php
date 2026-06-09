<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nome' => 'Carlos Eduardo',
                'email' => 'carlos@email.com',
                'senha' => Hash::make('senha123'),
                'perfil_id' => 1,
                'criado_em' => now(),
                'atualizado_em' => now(),
            ],
            [
                'nome' => 'Amanda Silva',
                'email' => 'amanda@email.com',
                'senha' => Hash::make('senha123'),
                'perfil_id' => 2,
                'criado_em' => now(),
                'atualizado_em' => now(),
            ],
        ]);
    }
}
