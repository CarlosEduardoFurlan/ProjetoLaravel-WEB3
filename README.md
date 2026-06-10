# ConnectZone

Projeto Laravel da disciplina WEB3. O sistema permite criar comunidades, participar delas e publicar conteúdos.

O principal relacionamento do projeto é muitos-para-muitos entre usuários e comunidades:

```text
usuarios <-> grupo_usuario <-> grupos
```

## Tecnologias

- Laravel 10
- PHP 8.1+
- PostgreSQL
- Blade
- HTML, CSS e JavaScript

## Como rodar

Instale as dependências:

```bash
composer install
```

Crie o arquivo `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

Configure o PostgreSQL no `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ProjetoLaravel-WEB3
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
```

Crie o banco no PostgreSQL com o mesmo nome definido em `DB_DATABASE`.

Depois rode:

```bash
php artisan migrate
php artisan db:seed --class=DemoDataSeeder
php artisan storage:link
php artisan serve
```

## Dados de teste

Para incluir dados de teste, use:

```bash
php artisan db:seed --class=DemoDataSeeder
```

Esse seeder cria perfis, usuários, comunidades, participações e publicações para facilitar a avaliação do sistema.

Acesse:

```text
http://127.0.0.1:8000
```

## Usuários de teste

Senha para todos:

```text
senha123
```

Administradores:

```text
carlos@email.com
marina.admin@email.com
```

Usuários comuns:

```text
amanda@email.com
joao@email.com
beatriz@email.com
```

## Funcionalidades

- Login, sessão e logout.
- Admin cria, edita e exclui comunidades próprias.
- Usuário participa de comunidades.
- Admin também pode participar de comunidades criadas por outros admins como membro comum.
- Usuários e admins podem publicar em comunidades.
- Usuários podem editar as próprias publicações.
- Criador da comunidade pode gerenciar sua comunidade.

## Estrutura principal

Models:

```text
app/Models/Usuario.php
app/Models/Perfil.php
app/Models/Grupo.php
app/Models/Publicacao.php
```

Controllers:

```text
app/Http/Controllers/AuthController.php
app/Http/Controllers/InicioController.php
app/Http/Controllers/ComunidadesController.php
app/Http/Controllers/ComunidadeController.php
app/Http/Controllers/UsuarioController.php
```

Tabela pivô do relacionamento N:N:

```text
grupo_usuario
```

## Rotas principais

```text
GET  /login
POST /login
POST /logout
GET  /inicio
GET  /comunidades
POST /comunidades
GET  /comunidade/{grupo}
POST /comunidade/{grupo}/publicacoes
PUT  /publicacoes/{publicacao}
GET  /usuario
GET  /usuario/comunidades
POST /usuario/comunidades/{grupo}/participar
```
