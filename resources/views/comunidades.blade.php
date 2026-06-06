<x-layout titulo="ConnectZone - Comunidades">
  <div class="topbar">
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Pesquisar comunidades...">
    </div>
    <button class="btn" id="openCreateModal">+ Criar Comunidade</button>
  </div>

  <h2 class="section-title">Todas as Comunidades</h2>

  <section class="community-grid" id="communityGrid">
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

  <div class="modal" id="createCommunityModal">
    <div class="modal-content">
      <h2>Criar Comunidade</h2>

      <div class="form-group">
        <label>Nome da comunidade</label>
        <input class="form-control" type="text" placeholder="Ex: DevConnect">
      </div>

      <div class="form-group">
        <label>Tema</label>
        <select class="form-select">
          <option>Tecnologia</option>
          <option>Games</option>
          <option>Anime</option>
          <option>Música</option>
          <option>Filmes</option>
        </select>
      </div>

      <div class="form-group">
        <label>Adicionar capa</label>
        <input class="form-control" type="file">
      </div>

      <div class="form-group">
        <label>Adicionar foto da página</label>
        <input class="form-control" type="file">
      </div>

      <div class="form-group">
        <label>Descrição</label>
        <textarea class="form-textarea" placeholder="Descrição da comunidade"></textarea>
      </div>

      <div class="actions">
        <button class="btn">Salvar</button>
        <button class="btn-secondary" id="closeCreateModal">Cancelar</button>
      </div>
    </div>
  </div>
</x-layout>