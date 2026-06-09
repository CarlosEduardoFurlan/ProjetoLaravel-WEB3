<x-layout :titulo="'Comunidade - ' . $grupo->nome">
  @php
      if (!empty($grupo->imagem_capa)) {
          $bannerUrl = asset('storage/' . ltrim($grupo->imagem_capa, '/'));
      } else {
          $bannerUrl = asset('images/sem-imagem-capa.svg');
      }
      if (!empty($grupo->imagem_logo)) {
          $avatarUrl = asset('storage/' . ltrim($grupo->imagem_logo, '/'));
      } else {
          $avatarUrl = asset('images/sem-imagem-avatar.svg');
      }
  @endphp
  <section class="community-page">
    <a href="{{ route('comunidades') }}" class="btn-secondary">← Voltar para Comunidades</a>

    <div class="community-cover" style="background-image: url('{{ $bannerUrl }}');"></div>

    <div class="community-header">
      <div class="community-info">
        <div class="community-avatar" style="background-image: url('{{ $avatarUrl }}');">
        </div>
        <div class="community-details">
          <h1>{{ $grupo->nome }}</h1>
          <p>{{ $grupo->descricao }}</p>
        </div>
      </div>

      <div class="actions">
        <button class="btn-secondary" id="openEditModal">Editar Comunidade</button>
        <form action="{{ route('comunidade.destroy', $grupo) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta comunidade?')">
          @csrf
          @method('DELETE')
          <button class="btn-secondary btn-danger" type="submit">Excluir Comunidade</button>
        </form>
      </div>
    </div>

    <div class="post-area">
      <div class="post-header">
        <h2>Publicações da Comunidade</h2>
        <button class="btn" id="openPostModal">+ Nova Publicação</button>
      </div>

      <div class="posts" id="postsContainer">
        @forelse ($grupo->publicacoes as $publicacao)
          <div class="post-card">
            <h3>{{ $publicacao->usuario->nome ?? 'Usuário' }}</h3>
            <p>{{ $publicacao->conteudo }}</p>
          </div>
        @empty
          <div class="post-card">
            <h3>Sem publicações</h3>
            <p>Ainda não há publicações nesta comunidade.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <x-modal id="editCommunityModal" titulo="Editar Comunidade">
    <form action="{{ route('comunidade.update', $grupo) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>Nome da comunidade</label>
        <input class="form-control" type="text" name="nome" value="{{ old('nome', $grupo->nome) }}" required>
      </div>

      <div class="form-group">
        <label>Tema</label>
        <select class="form-select" name="tema">
          <option value="Tecnologia" @selected(old('tema', $grupo->tema) === 'Tecnologia')>Tecnologia</option>
          <option value="Games" @selected(old('tema', $grupo->tema) === 'Games')>Games</option>
          <option value="Anime" @selected(old('tema', $grupo->tema) === 'Anime')>Anime</option>
          <option value="Música" @selected(old('tema', $grupo->tema) === 'Música')>Música</option>
          <option value="Filmes" @selected(old('tema', $grupo->tema) === 'Filmes')>Filmes</option>
        </select>
      </div>

      <div class="form-group">
        <label>Editar capa</label>
        <input class="form-control" type="file" name="imagem_capa" accept="image/*">
      </div>

      <div class="form-group">
        <label>Editar foto da página</label>
        <input class="form-control" type="file" name="imagem_logo" accept="image/*">
      </div>

      <div class="form-group">
        <label>Descrição</label>
        <textarea class="form-textarea" name="descricao">{{ old('descricao', $grupo->descricao) }}</textarea>
      </div>

      <div class="actions">
        <button class="btn" type="submit">Salvar</button>
        <button class="btn-secondary" id="closeEditModal" type="button">Cancelar</button>
      </div>
    </form>
  </x-modal>

  <x-modal id="postModal" titulo="Nova Publicação">
    <form action="{{ route('publicacoes.store', $grupo) }}" method="POST">
      @csrf

      <textarea class="form-textarea" id="postContent" name="conteudo" placeholder="Compartilhe algo com a comunidade..." required>{{ old('conteudo') }}</textarea>

      <div class="actions" style="margin-top:20px;">
        <button class="btn" type="submit">Publicar</button>
        <button class="btn-secondary" id="closePostModal" type="button">Cancelar</button>
      </div>
    </form>
  </x-modal>
</x-layout>
