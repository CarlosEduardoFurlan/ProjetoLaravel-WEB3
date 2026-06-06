-- Banco de dados: ConnectZone
-- PostgreSQL

CREATE TABLE perfis (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO perfis (nome) VALUES
('ADMINISTRADOR'),
('USUARIO');

CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil_id INTEGER NOT NULL REFERENCES perfis(id),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE grupos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    descricao TEXT,
    tema VARCHAR(80),
    imagem_capa VARCHAR(255),
    imagem_logo VARCHAR(255),
    usuario_criador_id INTEGER REFERENCES usuarios(id) ON DELETE SET NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela intermediária do relacionamento N:N
CREATE TABLE grupo_usuario (
    grupo_id INTEGER NOT NULL REFERENCES grupos(id) ON DELETE CASCADE,
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
    papel VARCHAR(30) DEFAULT 'MEMBRO',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (grupo_id, usuario_id)
);

CREATE TABLE publicacoes (
    id SERIAL PRIMARY KEY,
    grupo_id INTEGER NOT NULL REFERENCES grupos(id) ON DELETE CASCADE,
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
    conteudo TEXT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dados de exemplo
INSERT INTO usuarios (nome, email, senha, perfil_id)
VALUES
('Carlos Eduardo', 'carlos@email.com', 'senha_hash_aqui', 1),
('Amanda Silva', 'amanda@email.com', 'senha_hash_aqui', 2);

INSERT INTO grupos (nome, descricao, tema, usuario_criador_id)
VALUES
('DevConnect', 'Comunidade focada em Laravel, JavaScript e programação web.', 'Tecnologia', 1),
('Anime World', 'Discussões sobre animes, mangás e cultura japonesa.', 'Anime', 1);

INSERT INTO grupo_usuario (grupo_id, usuario_id, papel)
VALUES
(1, 1, 'ADMIN_GRUPO'),
(1, 2, 'MEMBRO'),
(2, 1, 'ADMIN_GRUPO');

INSERT INTO publicacoes (grupo_id, usuario_id, conteudo)
VALUES
(1, 1, 'Bem-vindos à comunidade DevConnect!');