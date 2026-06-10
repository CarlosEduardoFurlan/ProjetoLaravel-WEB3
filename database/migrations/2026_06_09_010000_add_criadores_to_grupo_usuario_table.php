<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $grupos = DB::table('grupos')
            ->whereNotNull('usuario_criador_id')
            ->get(['id', 'usuario_criador_id']);

        foreach ($grupos as $grupo) {
            $existe = DB::table('grupo_usuario')
                ->where('grupo_id', $grupo->id)
                ->where('usuario_id', $grupo->usuario_criador_id)
                ->exists();

            if (!$existe) {
                DB::table('grupo_usuario')->insert([
                    'grupo_id' => $grupo->id,
                    'usuario_id' => $grupo->usuario_criador_id,
                    'papel' => 'ADMIN_GRUPO',
                    'criado_em' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        //
    }
};
