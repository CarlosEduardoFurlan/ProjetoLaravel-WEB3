<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Publicacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComunidadeController extends Controller
{
    public function show(Grupo $grupo)
    {
        $grupo->load([
            'membros',
            'publicacoes' => fn ($query) => $query->with('usuario')->latest('criado_em'),
            'criador',
        ]);

        return view('comunidade', [
            'grupo' => $grupo,
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
        $grupo = Grupo::findOrFail($id);

        if ($grupo->usuario_criador_id !== $request->user()->id) {
            abort(403);
        }

        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:120'],
            'tema' => ['nullable', 'string', 'max:80'],
            'descricao' => ['nullable', 'string'],
            'imagem_capa' => ['nullable', 'image', 'max:2048'],
            'imagem_logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('imagem_capa')) {
            if ($grupo->imagem_capa) {
                Storage::disk('public')->delete($grupo->imagem_capa);
            }

            $dados['imagem_capa'] = $request->file('imagem_capa')->store('comunidades/capas', 'public');
        }

        if ($request->hasFile('imagem_logo')) {
            if ($grupo->imagem_logo) {
                Storage::disk('public')->delete($grupo->imagem_logo);
            }

            $dados['imagem_logo'] = $request->file('imagem_logo')->store('comunidades/logos', 'public');
        }

        $grupo->update($dados);

        return redirect()->route('comunidade', $grupo)->with('success', 'Comunidade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grupo = Grupo::findOrFail($id);

        if ($grupo->usuario_criador_id !== request()->user()->id) {
            abort(403);
        }

        if ($grupo->imagem_capa) {
            Storage::disk('public')->delete($grupo->imagem_capa);
        }

        if ($grupo->imagem_logo) {
            Storage::disk('public')->delete($grupo->imagem_logo);
        }

        $grupo->delete();

        return redirect()->route('comunidades')->with('success', 'Comunidade excluida com sucesso!');
    }

    public function storePublicacao(Request $request, Grupo $grupo)
    {
        $dados = $request->validate([
            'conteudo' => ['required', 'string'],
        ]);

        Publicacao::create([
            'grupo_id' => $grupo->id,
            'usuario_id' => $request->user()->id,
            'conteudo' => $dados['conteudo'],
        ]);

        return redirect()->route('comunidade', $grupo)->with('success', 'Publicacao criada com sucesso!');
    }

    public function updatePublicacao(Request $request, Publicacao $publicacao)
    {
        $podeGerenciarComunidade = $request->user()->perfil?->nome === 'ADMINISTRADOR'
            && $publicacao->grupo->usuario_criador_id === $request->user()->id;

        if ($publicacao->usuario_id !== $request->user()->id && !$podeGerenciarComunidade) {
            abort(403);
        }

        $dados = $request->validate([
            'conteudo' => ['required', 'string'],
        ]);

        $publicacao->update($dados);

        return redirect()
            ->route('comunidade', $publicacao->grupo)
            ->with('success', 'Publicacao atualizada com sucesso!');
    }
}
