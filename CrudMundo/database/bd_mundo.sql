CREATE DATABASE IF NOT EXISTS bd_mundo;
USE bd_mundo;

-- Tabela de Continentes
CREATE TABLE continentes (
    id_continente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    populacao BIGINT,
    area DECIMAL(10,2),
    total_paises INT
);

-- Tabela de Governantes
CREATE TABLE governantes (
    id_governante INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    partido_politico VARCHAR(100),
    data_nascimento DATE,
    idade INT,
    data_inicio_mandato DATE,
    data_fim_mandato DATE
);

-- Tabela de Países
CREATE TABLE paises (
    id_pais INT AUTO_INCREMENT PRIMARY KEY,
    id_continente INT,
    id_governante INT,
    nome VARCHAR(100) NOT NULL,
    populacao BIGINT,
    area DECIMAL(10,2),
    idioma VARCHAR(100),
    clima VARCHAR(100),
    regime_politico VARCHAR(100),
    moeda VARCHAR(50),
    FOREIGN KEY (id_continente) REFERENCES continentes(id_continente) ON DELETE SET NULL,
    FOREIGN KEY (id_governante) REFERENCES governantes(id_governante) ON DELETE SET NULL
);

-- Tabela de Cidades
CREATE TABLE cidades (
    id_cidade INT AUTO_INCREMENT PRIMARY KEY,
    id_pais INT,
    nome VARCHAR(100) NOT NULL,
    populacao BIGINT,
    area DECIMAL(10,2),
    clima VARCHAR(100),
    data_fundacao DATE,
    FOREIGN KEY (id_pais) REFERENCES paises(id_pais) ON DELETE CASCADE
);

-- Tabela de Usuários com controle de tentativas e primeiro acesso
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tentativas_invalidas INT DEFAULT 0,
    bloqueado TINYINT(1) DEFAULT 0,
    primeiro_acesso TINYINT(1) DEFAULT 1
);

-- Tabela de Logs
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    acao VARCHAR(255) NOT NULL,
    ip_origem VARCHAR(45),
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Insere o usuário Admin. A senha padrão é 123456 (já com hash criptografado bcrypt)
INSERT INTO usuarios (nome, email, senha, primeiro_acesso) 
VALUES ('Administrador', 'admin@mundo.com', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1152aM4Dq./uR9yL5PqP017zW4c3L8y', 1);