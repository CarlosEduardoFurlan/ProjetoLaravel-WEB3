# Projeto Laravel 

## Requisitos

- PHP 8.x
- Composer
- Node.js + npm (se for necessário compilar assets)

## Passos rápidos (recomendado — SQLite para avaliação)

1. Clone o repositório e entre na pasta:

```bash
git clone <url-do-repo>
cd ProjetoLaravel-WEB3
```

2. Instale dependências PHP e JS:

```bash
composer install
npm install
# opcional: npm run build  (ou npm run dev para desenvolvimento)
```

3. Copie o arquivo de exemplo de ambiente e gere a chave da aplicação:

```bash
cp .env.example .env
php artisan key:generate
```

4. (Recomendado para avaliação) Use SQLite para evitar configurar MySQL:

```bash
touch database/database.sqlite
# Edite .env e ajuste:
# DB_CONNECTION=sqlite
# DB_DATABASE=/caminho/para/seu/projeto/database/database.sqlite
```

Você pode editar o `.env` manualmente ou executar um editor de texto e definir `DB_CONNECTION=sqlite` e `DB_DATABASE=database/database.sqlite`.

5. Rode migrations e seeders para popular dados de exemplo:

```bash
php artisan migrate --seed
```

6. Inicie o servidor local:

```bash
php artisan serve
# abrir http://127.0.0.1:8000
```

7. Roteiros úteis para checar a aplicação:

- Página principal / início: `http://127.0.0.1:8000`
- Lista de comunidades: `/comunidades`

