@props([
    'id',
    'titulo',
    'action',
    'method' => 'POST',
    'enctype' => null,
    'submitLabel' => 'Salvar',
    'cancelLabel' => 'Cancelar',
    'closeId' => null,
    'formType' => null,
    'grupo' => null,
])

@php
    $temaAtual = old('tema', $grupo->tema ?? null);
@endphp

<div class="modal" id="{{ $id }}">
  <div class="modal-content">
    <h2>{{ $titulo }}</h2>

    <form action="{{ $action }}" method="POST" @if ($enctype) enctype="{{ $enctype }}" @endif>
      @csrf

      @if (strtoupper($method) !== 'POST')
        @method($method)
      @endif

      @if ($formType === 'community')
        <div class="form-group">
          <label>Nome da comunidade</label>
          <input class="form-control" type="text" name="nome" value="{{ old('nome', $grupo->nome ?? '') }}" placeholder="Ex: DevConnect" required>
        </div>

        <div class="form-group">
          <label>Tema</label>
          <select class="form-select" name="tema">
            <option value="Tecnologia" @selected($temaAtual === 'Tecnologia')>Tecnologia</option>
            <option value="Games" @selected($temaAtual === 'Games')>Games</option>
            <option value="Anime" @selected($temaAtual === 'Anime')>Anime</option>
            <option value="Música" @selected($temaAtual === 'Música')>Música</option>
            <option value="Filmes" @selected($temaAtual === 'Filmes')>Filmes</option>
          </select>
        </div>

        <div class="form-group">
          <label>{{ $grupo ? 'Editar capa' : 'Adicionar capa' }}</label>
          <input class="form-control" type="file" name="imagem_capa" accept="image/*">
        </div>

        <div class="form-group">
          <label>{{ $grupo ? 'Editar foto da página' : 'Adicionar foto da página' }}</label>
          <input class="form-control" type="file" name="imagem_logo" accept="image/*">
        </div>

        <div class="form-group">
          <label>Descrição</label>
          <textarea class="form-textarea" name="descricao" placeholder="Descrição da comunidade">{{ old('descricao', $grupo->descricao ?? '') }}</textarea>
        </div>
      @else
        {{ $slot }}
      @endif

      <div class="actions">
        <button class="btn" type="submit">{{ $submitLabel }}</button>

        @if ($closeId)
          <button class="btn-secondary" id="{{ $closeId }}" type="button">{{ $cancelLabel }}</button>
        @endif
      </div>
    </form>
  </div>
</div>
