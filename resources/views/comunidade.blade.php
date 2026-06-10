<x-layout :titulo="'Comunidade - ' . $grupo->nome">
  @php
      $usuarioLogado = auth()->user();
      $isAdmin = $usuarioLogado->perfil?->nome === 'ADMINISTRADOR';
      $isCriador = $isAdmin && $grupo->usuario_criador_id === $usuarioLogado->id;
      $voltarRoute = match (true) {
          $isCriador => route('inicio'),
          $isAdmin => route('comunidades'),
          default => route('usuario.comunidades'),
      };
      $voltarTexto = $isCriador ? 'Voltar para suas Comunidades' : 'Voltar para Comunidades';

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
    <a href="{{ $voltarRoute }}" class="btn-secondary">← {{ $voltarTexto }}</a>

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

      @if ($isCriador)
        <div class="actions">
          <button class="btn-secondary" id="openEditModal">Editar Comunidade</button>
          <form action="{{ route('comunidade.destroy', $grupo) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta comunidade?')">
            @csrf
            @method('DELETE')
            <button class="btn-secondary btn-danger" type="submit">Excluir Comunidade</button>
          </form>
        </div>
      @endif
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

            @if ($isCriador || $publicacao->usuario_id === $usuarioLogado->id)
              <div class="post-actions">
                <button class="btn-secondary" type="button" data-modal-open="editPostModal{{ $publicacao->id }}">Editar</button>
              </div>
            @endif
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

  @if ($isCriador)
    <x-modal
      id="editCommunityModal"
      titulo="Editar Comunidade"
      :action="route('comunidade.update', $grupo)"
      method="PUT"
      enctype="multipart/form-data"
      form-type="community"
      :grupo="$grupo"
      close-id="closeEditModal"
    />
  @endif

  <x-modal
    id="postModal"
    titulo="Nova Publicação"
    :action="route('publicacoes.store', $grupo)"
    submit-label="Publicar"
    close-id="closePostModal"
  >
    <textarea class="form-textarea" id="postContent" name="conteudo" placeholder="Compartilhe algo com a comunidade..." required>{{ old('conteudo') }}</textarea>
  </x-modal>

  @foreach ($grupo->publicacoes as $publicacao)
    @if ($isCriador || $publicacao->usuario_id === $usuarioLogado->id)
      <x-modal
        id="editPostModal{{ $publicacao->id }}"
        titulo="Editar Publicação"
        :action="route('publicacoes.update', $publicacao)"
        method="PUT"
        submit-label="Salvar"
        close-id="closeEditPostModal{{ $publicacao->id }}"
      >
        <textarea class="form-textarea" name="conteudo" required>{{ old('conteudo', $publicacao->conteudo) }}</textarea>
      </x-modal>
    @endif
  @endforeach
</x-layout>
