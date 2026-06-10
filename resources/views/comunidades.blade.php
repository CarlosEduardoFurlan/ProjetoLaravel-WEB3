<x-layout titulo="ConnectZone - Comunidades">
  <div class="topbar">
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Pesquisar comunidades...">
    </div>
    <button class="btn" id="openCreateModal">+ Criar Comunidade</button>
  </div>

  <h2 class="section-title">Comunidades que você participa</h2>

  @if ($comunidadesParticipando->isEmpty())
    <div class="post-card">
      <h3>Você ainda não participa de comunidades de outros admins</h3>
      <p>Use a seção Outras Comunidades para participar de uma comunidade.</p>
    </div>
  @else
    <div class="community-grid">
      @foreach ($comunidadesParticipando as $grupo)
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
            <span>👥 {{ $grupo->membros_count }} membros</span>
            <span class="tag">{{ $grupo->tema }}</span>
          </div>
          <a href="{{ route('comunidade', ['grupo' => $grupo->id]) }}" class="btn">Entrar</a>
        </div>
      @endforeach
    </div>
  @endif

  <h2 class="section-title section-spaced">Outras Comunidades</h2>

  @if ($outrasComunidades->isEmpty())
    <div class="post-card">
      <h3>Nenhuma comunidade disponível</h3>
      <p>Quando outros administradores criarem novas comunidades, elas aparecerão aqui.</p>
    </div>
  @else
    <div class="community-grid">
      @foreach ($outrasComunidades as $grupo)
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
            <span>👥 {{ $grupo->membros_count }} membros</span>
            <span class="tag">{{ $grupo->tema }}</span>
          </div>
          <form action="{{ route('usuario.comunidades.participar', $grupo) }}" method="POST">
            @csrf
            <button class="btn" type="submit">Participar</button>
          </form>
        </div>
      @endforeach
    </div>
  @endif

  <x-modal
    id="createCommunityModal"
    titulo="Criar Comunidade"
    :action="route('comunidades.store')"
    enctype="multipart/form-data"
    form-type="community"
    close-id="closeCreateModal"
  />
</x-layout>
