<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $agora = now();

        DB::table('perfis')->updateOrInsert(
            ['nome' => 'ADMINISTRADOR'],
            ['nome' => 'ADMINISTRADOR']
        );

        DB::table('perfis')->updateOrInsert(
            ['nome' => 'USUARIO'],
            ['nome' => 'USUARIO']
        );

        $perfilAdminId = DB::table('perfis')->where('nome', 'ADMINISTRADOR')->value('id');
        $perfilUsuarioId = DB::table('perfis')->where('nome', 'USUARIO')->value('id');

        $usuarios = [
            ['nome' => 'Carlos Eduardo', 'email' => 'carlos@email.com', 'perfil_id' => $perfilAdminId],
            ['nome' => 'Marina Admin', 'email' => 'marina.admin@email.com', 'perfil_id' => $perfilAdminId],
            ['nome' => 'Amanda Silva', 'email' => 'amanda@email.com', 'perfil_id' => $perfilUsuarioId],
            ['nome' => 'Joao Pereira', 'email' => 'joao@email.com', 'perfil_id' => $perfilUsuarioId],
            ['nome' => 'Beatriz Lima', 'email' => 'beatriz@email.com', 'perfil_id' => $perfilUsuarioId],
        ];

        foreach ($usuarios as $usuario) {
            DB::table('usuarios')->updateOrInsert(
                ['email' => $usuario['email']],
                [
                    'nome' => $usuario['nome'],
                    'senha' => Hash::make('senha123'),
                    'perfil_id' => $usuario['perfil_id'],
                    'atualizado_em' => $agora,
                    'criado_em' => $agora,
                ]
            );
        }

        $carlosId = DB::table('usuarios')->where('email', 'carlos@email.com')->value('id');
        $marinaId = DB::table('usuarios')->where('email', 'marina.admin@email.com')->value('id');
        $amandaId = DB::table('usuarios')->where('email', 'amanda@email.com')->value('id');
        $joaoId = DB::table('usuarios')->where('email', 'joao@email.com')->value('id');
        $beatrizId = DB::table('usuarios')->where('email', 'beatriz@email.com')->value('id');

        $grupos = [
            [
                'nome' => 'DevConnect',
                'descricao' => 'Comunidade focada em Laravel, JavaScript e desenvolvimento web.',
                'tema' => 'Tecnologia',
                'usuario_criador_id' => $carlosId,
            ],
            [
                'nome' => 'Anime World',
                'descricao' => 'Discussões sobre animes, mangás e cultura japonesa.',
                'tema' => 'Anime',
                'usuario_criador_id' => $carlosId,
            ],
            [
                'nome' => 'GameHub',
                'descricao' => 'Espaço para falar sobre jogos, lançamentos e campeonatos.',
                'tema' => 'Games',
                'usuario_criador_id' => $marinaId,
            ],
            [
                'nome' => 'Music Lab',
                'descricao' => 'Comunidade para compartilhar artistas, playlists e produção musical.',
                'tema' => 'Música',
                'usuario_criador_id' => $marinaId,
            ],
            [
                'nome' => 'Cine Clube',
                'descricao' => 'Indicações, críticas e conversas sobre filmes e séries.',
                'tema' => 'Filmes',
                'usuario_criador_id' => $carlosId,
            ],
        ];

        foreach ($grupos as $grupo) {
            DB::table('grupos')->updateOrInsert(
                ['nome' => $grupo['nome']],
                [
                    'descricao' => $grupo['descricao'],
                    'tema' => $grupo['tema'],
                    'usuario_criador_id' => $grupo['usuario_criador_id'],
                    'atualizado_em' => $agora,
                    'criado_em' => $agora,
                ]
            );
        }

        $grupoIds = DB::table('grupos')->pluck('id', 'nome');

        $participacoes = [
            ['grupo_id' => $grupoIds['DevConnect'], 'usuario_id' => $carlosId, 'papel' => 'ADMIN_GRUPO'],
            ['grupo_id' => $grupoIds['DevConnect'], 'usuario_id' => $amandaId, 'papel' => 'MEMBRO'],
            ['grupo_id' => $grupoIds['DevConnect'], 'usuario_id' => $joaoId, 'papel' => 'MEMBRO'],
            ['grupo_id' => $grupoIds['Anime World'], 'usuario_id' => $carlosId, 'papel' => 'ADMIN_GRUPO'],
            ['grupo_id' => $grupoIds['Anime World'], 'usuario_id' => $beatrizId, 'papel' => 'MEMBRO'],
            ['grupo_id' => $grupoIds['GameHub'], 'usuario_id' => $marinaId, 'papel' => 'ADMIN_GRUPO'],
            ['grupo_id' => $grupoIds['GameHub'], 'usuario_id' => $joaoId, 'papel' => 'MEMBRO'],
            ['grupo_id' => $grupoIds['Music Lab'], 'usuario_id' => $marinaId, 'papel' => 'ADMIN_GRUPO'],
            ['grupo_id' => $grupoIds['Music Lab'], 'usuario_id' => $amandaId, 'papel' => 'MEMBRO'],
            ['grupo_id' => $grupoIds['Cine Clube'], 'usuario_id' => $carlosId, 'papel' => 'ADMIN_GRUPO'],
        ];

        foreach ($participacoes as $participacao) {
            DB::table('grupo_usuario')->updateOrInsert(
                [
                    'grupo_id' => $participacao['grupo_id'],
                    'usuario_id' => $participacao['usuario_id'],
                ],
                [
                    'papel' => $participacao['papel'],
                    'criado_em' => $agora,
                ]
            );
        }

        $publicacoes = [
            ['grupo' => 'DevConnect', 'usuario_id' => $carlosId, 'conteudo' => 'Bem-vindos a DevConnect! Compartilhem dúvidas e projetos por aqui.'],
            ['grupo' => 'DevConnect', 'usuario_id' => $amandaId, 'conteudo' => 'Estou estudando migrations no Laravel. Alguém tem dicas?'],
            ['grupo' => 'Anime World', 'usuario_id' => $beatrizId, 'conteudo' => 'Qual anime vocês recomendam para começar esta semana?'],
            ['grupo' => 'GameHub', 'usuario_id' => $marinaId, 'conteudo' => 'Hoje vamos falar sobre jogos cooperativos para jogar em equipe.'],
            ['grupo' => 'Music Lab', 'usuario_id' => $amandaId, 'conteudo' => 'Criei uma playlist nova para estudar programação.'],
            ['grupo' => 'Cine Clube', 'usuario_id' => $carlosId, 'conteudo' => 'Postem indicações de filmes com tema tecnologia.'],
        ];

        foreach ($publicacoes as $publicacao) {
            DB::table('publicacoes')->updateOrInsert(
                [
                    'grupo_id' => $grupoIds[$publicacao['grupo']],
                    'usuario_id' => $publicacao['usuario_id'],
                    'conteudo' => $publicacao['conteudo'],
                ],
                [
                    'atualizado_em' => $agora,
                    'criado_em' => $agora,
                ]
            );
        }
    }
}
