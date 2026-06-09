<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicacoesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('publicacoes')->insert([
            [
                'grupo_id' => 1,
                'usuario_id' => 1,
                'conteudo' => 'Bem-vindos à comunidade DevConnect!',
                'criado_em' => now(),
                'atualizado_em' => now(),
            ],
        ]);
    }
}
