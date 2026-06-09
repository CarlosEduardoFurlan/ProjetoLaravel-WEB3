<x-layout titulo="ConnectZone - Início">
  <section class="hero">
    <div>
      <h1>Explore novas comunidades 🚀</h1>
      <p>Participe de grupos sobre tecnologia, games, música, anime e muito mais.</p>
    </div>
    <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" alt="Comunidades">
  </section>

  <h2 class="section-title">Comunidades Populares</h2>

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
</x-layout>