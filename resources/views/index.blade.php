<x-layout titulo="ConnectZone - Início">
  <section class="hero">
    <div>
      <h1>Explore novas comunidades 🚀</h1>
      <p>Participe de grupos sobre tecnologia, games, música, anime e muito mais.</p>
    </div>
    <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" alt="Comunidades">
  </section>

  <h2 class="section-title">Comunidades Populares</h2>

  <section class="community-grid">
    <div class="card">
      <div class="card-banner tech"></div>
      <h2>DevConnect</h2>
      <p>Comunidade focada em Laravel, JavaScript e programação web.</p>
      <div class="members">
        <span>👥 3.1k membros</span>
        <span class="tag">Tecnologia</span>
      </div>
      <a href="{{ route('comunidade') }}" class="btn">Entrar</a>
    </div>

    <div class="card">
      <div class="card-banner anime"></div>
      <h2>Anime World</h2>
      <p>Discussões sobre animes, mangás e cultura japonesa.</p>
      <div class="members">
        <span>👥 1.8k membros</span>
        <span class="tag">Anime</span>
      </div>
      <a href="{{ route('comunidade') }}" class="btn">Entrar</a>
    </div>

    <div class="card">
      <div class="card-banner gaming"></div>
      <h2>GameVerse</h2>
      <p>Comunidade para jogadores de FPS, RPG e partidas online.</p>
      <div class="members">
        <span>👥 2.4k membros</span>
        <span class="tag">Games</span>
      </div>
      <a href="{{ route('comunidade') }}" class="btn">Entrar</a>
    </div>
  </section>
</x-layout>