<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('perfis')->insert([
            ['nome' => 'ADMINISTRADOR'],
            ['nome' => 'USUARIO'],
        ]);
    }
}
