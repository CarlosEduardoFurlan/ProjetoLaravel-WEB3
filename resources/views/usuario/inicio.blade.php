<x-layout titulo="ConnectZone - Usuário">
  <section class="hero">
    <div>
      <h1>Bem-vindo, {{ auth()->user()->nome }}</h1>
      <p>Acompanhe as comunidades das quais você faz parte e participe das conversas.</p>
    </div>
    <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" alt="Comunidades">
  </section>

  <h2 class="section-title">Suas Comunidades</h2>

  @if ($grupos->isEmpty())
    <div class="post-card">
      <h3>Você ainda não participa de comunidades</h3>
      <p>Acesse a página de comunidades para encontrar grupos disponíveis.</p>
      <a href="{{ route('usuario.comunidades') }}" class="btn">Ver Comunidades</a>
    </div>
  @else
    <div class="community-grid">
      @foreach ($grupos as $grupo)
        @php
          if (!empty($grupo->imagem_capa)) {
              $bannerUrl = asset('storage/' . ltrim($grupo->imagem_capa, '/'));
          } else {
              $bannerUrl = asset('images/sem-imagem-capa.svg');
          }
        @endphp

        <article class="card">
          <div class="card-banner" style="background-image: url('{{ $bannerUrl }}');"></div>
          <h2>{{ $grupo->nome }}</h2>
          <p>{{ $grupo->descricao }}</p>
          <div class="members">
            <span>👥 {{ $grupo->membros_count }} membros</span>
            <span class="tag">{{ $grupo->tema }}</span>
          </div>
          <a href="{{ route('comunidade', ['grupo' => $grupo->id]) }}" class="btn">Entrar</a>
        </article>
      @endforeach
    </div>
  @endif
</x-layout>
