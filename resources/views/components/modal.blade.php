@props(['id', 'titulo'])

<div class="modal" id="{{ $id }}">
  <div class="modal-content">
    <h2>{{ $titulo }}</h2>

    {{ $slot }}
  </div>
</div>
