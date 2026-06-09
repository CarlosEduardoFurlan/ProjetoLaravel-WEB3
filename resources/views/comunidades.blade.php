<x-layout titulo="ConnectZone - Comunidades">
  <div class="topbar">
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Pesquisar comunidades...">
    </div>
    <button class="btn" id="openCreateModal">+ Criar Comunidade</button>
  </div>

  <h2 class="section-title">Todas as Comunidades</h2>

  @foreach ($grupos as $grupo)
    @php
        if (!empty($grupo->imagem_capa)) {
            $bannerUrl = asset('storage/' . ltrim($grupo->imagem_capa, '/'));
        } else {
            $bannerUrl = asset('images/sem-imagem-capa.svg');
        }
    @endphp
    <div class="card">
      <div class="card-banner" style="background-image: url('{{ $bannerUrl }}');"></div>
      <h2>{{ $grupo->nome }}</h2>
      <p>{{ $grupo->descricao }}</p>
      <div class="members">
        <span>👥 {{ $grupo->membros->count() }} membros</span>
        <span class="tag">{{ $grupo->tema }}</span>
      </div>
      <a href="{{ route('comunidade', ['grupo' => $grupo->id]) }}" class="btn">Entrar</a>
    </div>
  @endforeach

  <x-modal id="createCommunityModal" titulo="Criar Comunidade">
    <form action="{{ route('comunidades.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label>Nome da comunidade</label>
        <input class="form-control" type="text" name="nome" value="{{ old('nome') }}" placeholder="Ex: DevConnect" required>
      </div>

      <div class="form-group">
        <label>Tema</label>
        <select class="form-select" name="tema">
          <option value="Tecnologia" @selected(old('tema') === 'Tecnologia')>Tecnologia</option>
          <option value="Games" @selected(old('tema') === 'Games')>Games</option>
          <option value="Anime" @selected(old('tema') === 'Anime')>Anime</option>
          <option value="Música" @selected(old('tema') === 'Música')>Música</option>
          <option value="Filmes" @selected(old('tema') === 'Filmes')>Filmes</option>
        </select>
      </div>

      <div class="form-group">
        <label>Adicionar capa</label>
        <input class="form-control" type="file" name="imagem_capa" accept="image/*">
      </div>

      <div class="form-group">
        <label>Adicionar foto da página</label>
        <input class="form-control" type="file" name="imagem_logo" accept="image/*">
      </div>

      <div class="form-group">
        <label>Descrição</label>
        <textarea class="form-textarea" name="descricao" placeholder="Descrição da comunidade">{{ old('descricao') }}</textarea>
      </div>

      <div class="actions">
        <button class="btn" type="submit">Salvar</button>
        <button class="btn-secondary" id="closeCreateModal" type="button">Cancelar</button>
      </div>
    </form>
  </x-modal>
</x-layout>
