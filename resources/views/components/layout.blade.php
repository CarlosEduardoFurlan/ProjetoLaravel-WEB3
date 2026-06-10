<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $titulo }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="layout">
    <aside class="sidebar">
      <div>
        <div class="logo">ConnectZone</div>
        <nav class="menu">
          @auth
            @if (auth()->user()->perfil?->nome === 'ADMINISTRADOR')
              <a href="{{ route('inicio') }}" @class(['active' => request()->routeIs('inicio')])>🏠 Início</a>
              <a href="{{ route('comunidades') }}" @class(['active' => request()->routeIs('comunidades')])>👥 Comunidades</a>
            @else
              <a href="{{ route('usuario.inicio') }}" @class(['active' => request()->routeIs('usuario.inicio')])>🏠 Início</a>
              <a href="{{ route('usuario.comunidades') }}" @class(['active' => request()->routeIs('usuario.comunidades')])>👥 Comunidades</a>
            @endif
          @endauth
        </nav>
      </div>

      @auth
        <div class="profile">
          <h3>{{ auth()->user()->nome }}</h3>
          <span>{{ auth()->user()->perfil?->nome }}</span>

          <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button class="btn-secondary" type="submit">Sair</button>
          </form>
        </div>
      @endauth
    </aside>

    <main class="main">
      {{ $slot }}

      <div class="footer">© 2026 ConnectZone • Projeto WEB III</div>
    </main>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
