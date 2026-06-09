@props([
    'id',
    'titulo',
    'action',
    'method' => 'POST',
    'enctype' => null,
    'submitLabel' => 'Salvar',
    'cancelLabel' => 'Cancelar',
    'closeId' => null,
])

<div class="modal" id="{{ $id }}">
  <div class="modal-content">
    <h2>{{ $titulo }}</h2>

    <form action="{{ $action }}" method="POST" @if ($enctype) enctype="{{ $enctype }}" @endif>
      @csrf

      @if (strtoupper($method) !== 'POST')
        @method($method)
      @endif

      {{ $slot }}

      <div class="actions">
        <button class="btn" type="submit">{{ $submitLabel }}</button>

        @if ($closeId)
          <button class="btn-secondary" id="{{ $closeId }}" type="button">{{ $cancelLabel }}</button>
        @endif
      </div>
    </form>
  </div>
</div>
