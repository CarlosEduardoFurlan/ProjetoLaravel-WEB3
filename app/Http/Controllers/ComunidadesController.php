<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class ComunidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idsComunidadesUsuario = auth()->user()->grupos()->pluck('grupos.id');

        $comunidadesParticipando = Grupo::withCount('membros')
            ->where('usuario_criador_id', '!=', auth()->id())
            ->whereIn('id', $idsComunidadesUsuario)
            ->latest('criado_em')
            ->get();

        $outrasComunidades = Grupo::withCount('membros')
            ->where('usuario_criador_id', '!=', auth()->id())
            ->whereNotIn('id', $idsComunidadesUsuario)
            ->latest('criado_em')
            ->get();

        return view('comunidades',[
            'comunidadesParticipando' => $comunidadesParticipando,
            'outrasComunidades' => $outrasComunidades,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:120'],
            'tema' => ['nullable', 'string', 'max:80'],
            'descricao' => ['nullable', 'string'],
            'imagem_capa' => ['nullable', 'image', 'max:2048'],
            'imagem_logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('imagem_capa')) {
            $dados['imagem_capa'] = $request->file('imagem_capa')->store('comunidades/capas', 'public');
        }

        if ($request->hasFile('imagem_logo')) {
            $dados['imagem_logo'] = $request->file('imagem_logo')->store('comunidades/logos', 'public');
        }

        $dados['usuario_criador_id'] = $request->user()->id;

        $grupo = Grupo::create($dados);

        $grupo->membros()->attach($request->user()->id, [
            'papel' => 'ADMIN_GRUPO',
            'criado_em' => now(),
        ]);

        return redirect()->route('comunidade', $grupo)->with('success', 'Comunidade criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
