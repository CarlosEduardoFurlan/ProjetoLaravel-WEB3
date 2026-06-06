<x-layout titulo="Comunidade">
  <section class="community-page">
    <a href="{{ route('comunidades') }}" class="btn-secondary">← Voltar para Comunidades</a>

    <div class="community-cover"></div>

    <div class="community-header">
      <div class="community-info">
        <div class="community-avatar">D</div>
        <div class="community-details">
          <h1>DevConnect</h1>
          <p>Comunidade focada em Laravel, JavaScript e programação web.</p>
        </div>
      </div>

      <div class="actions">
        <button class="btn-secondary" id="openEditModal">Editar Comunidade</button>
        <button class="btn-secondary btn-danger" id="deleteCommunityBtn">Excluir Comunidade</button>
      </div>
    </div>

    <div class="post-area">
      <div class="post-header">
        <h2>Publicações da Comunidade</h2>
        <button class="btn" id="openPostModal">+ Nova Publicação</button>
      </div>

      <div class="posts" id="postsContainer">
        <div class="post-card">
          <h3>Carlos Eduardo</h3>
          <p>Bem-vindos à comunidade 🚀</p>
        </div>
      </div>
    </div>
  </section>

  <div class="modal" id="editCommunityModal">
    <div class="modal-content">
      <h2>Editar Comunidade</h2>

      <div class="form-group">
        <label>Nome da comunidade</label>
        <input class="form-control" type="text" value="DevConnect">
      </div>

      <div class="form-group">
        <label>Tema</label>
        <select class="form-select">
          <option selected>Tecnologia</option>
          <option>Games</option>
          <option>Anime</option>
          <option>Música</option>
        </select>
      </div>

      <div class="form-group">
        <label>Editar capa</label>
        <input class="form-control" type="file">
      </div>

      <div class="form-group">
        <label>Editar foto da página</label>
        <input class="form-control" type="file">
      </div>

      <div class="form-group">
        <label>Descrição</label>
        <textarea class="form-textarea">Comunidade focada em Laravel, JavaScript e programação web.</textarea>
      </div>

      <div class="actions">
        <button class="btn">Salvar</button>
        <button class="btn-secondary" id="closeEditModal">Cancelar</button>
      </div>
    </div>
  </div>

  <div class="modal" id="postModal">
    <div class="modal-content">
      <h2>Nova Publicação</h2>

      <textarea class="form-textarea" id="postContent" placeholder="Compartilhe algo com a comunidade..."></textarea>

      <div class="actions" style="margin-top:20px;">
        <button class="btn" id="publishPostBtn">Publicar</button>
        <button class="btn-secondary" id="closePostModal">Cancelar</button>
      </div>
    </div>
  </div>
</x-layout>