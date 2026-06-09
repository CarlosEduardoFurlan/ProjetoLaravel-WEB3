<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoUsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('grupo_usuario')->insert([
            ['grupo_id' => 1, 'usuario_id' => 1, 'papel' => 'ADMIN_GRUPO', 'criado_em' => now()],
            ['grupo_id' => 1, 'usuario_id' => 2, 'papel' => 'MEMBRO', 'criado_em' => now()],
            ['grupo_id' => 2, 'usuario_id' => 1, 'papel' => 'ADMIN_GRUPO', 'criado_em' => now()],
        ]);
    }
}
