<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $grupos = $request->user()
            ->grupos()
            ->withCount('membros')
            ->latest('grupos.criado_em')
            ->get();

        return view('usuario.inicio', [
            'grupos' => $grupos,
        ]);
    }

    public function comunidades()
    {
        $idsComunidadesUsuario = request()->user()->grupos()->pluck('grupos.id');
        $grupos = Grupo::withCount('membros')
            ->whereNotIn('id', $idsComunidadesUsuario)
            ->latest('criado_em')
            ->get();

        return view('usuario.comunidades', [
            'grupos' => $grupos,
        ]);
    }

    public function participar(Request $request, Grupo $grupo)
    {
        $request->user()->grupos()->syncWithoutDetaching([
            $grupo->id => [
                'papel' => 'MEMBRO',
                'criado_em' => now(),
            ],
        ]);

        return redirect()->route('comunidade', $grupo)->with('success', 'Voce entrou na comunidade!');
    }
}
