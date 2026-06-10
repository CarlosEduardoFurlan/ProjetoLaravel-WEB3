<x-layout titulo="ConnectZone - Comunidades">
  <h2 class="section-title">Comunidades Disponíveis</h2>

  @if ($grupos->isEmpty())
    <div class="post-card">
      <h3>Nenhuma comunidade disponível</h3>
      <p>Você já participa de todas as comunidades criadas até agora.</p>
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

          <form action="{{ route('usuario.comunidades.participar', $grupo) }}" method="POST">
            @csrf
            <button class="btn" type="submit">Participar</button>
          </form>
        </article>
      @endforeach
    </div>
  @endif
</x-layout>
