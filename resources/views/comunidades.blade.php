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

  <x-modal
    id="createCommunityModal"
    titulo="Criar Comunidade"
    :action="route('comunidades.store')"
    enctype="multipart/form-data"
    form-type="community"
    close-id="closeCreateModal"
  />
</x-layout>
