<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GruposSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('grupos')->insert([
            [
                'nome' => 'DevConnect',
                'descricao' => 'Comunidade focada em Laravel, JavaScript e programação web.',
                'tema' => 'Tecnologia',
                'usuario_criador_id' => 1,
                'criado_em' => now(),
                'atualizado_em' => now(),
            ],
            [
                'nome' => 'Anime World',
                'descricao' => 'Discussões sobre animes, mangás e cultura japonesa.',
                'tema' => 'Anime',
                'usuario_criador_id' => 1,
                'criado_em' => now(),
                'atualizado_em' => now(),
            ],
        ]);
    }
}
