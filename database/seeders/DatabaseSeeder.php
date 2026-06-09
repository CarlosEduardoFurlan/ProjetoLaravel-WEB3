<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PerfisSeeder::class,
            UsuariosSeeder::class,
            GruposSeeder::class,
            GrupoUsuarioSeeder::class,
            PublicacoesSeeder::class,
        ]);
    }
}
