<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ConnectZone - Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <main class="auth-page">
    <section class="auth-panel">
      <div class="auth-brand">
        <h1>ConnectZone</h1>
        <p>Entre para acessar sua área.</p>
      </div>

      <form action="{{ route('login.store') }}" method="POST" class="auth-form">
        @csrf

        @if ($errors->any())
          <div class="alert-error">
            {{ $errors->first() }}
          </div>
        @endif

        <div class="form-group">
          <label>E-mail</label>
          <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required autofocus>
        </div>

        <div class="form-group">
          <label>Senha</label>
          <input class="form-control" type="password" name="senha" placeholder="Sua senha" required>
        </div>

        <label class="check-row">
          <input type="checkbox" name="lembrar" value="1">
          <span>Lembrar acesso</span>
        </label>

        <button class="btn auth-submit" type="submit">Entrar</button>
      </form>
    </section>
  </main>
</body>
</html>
