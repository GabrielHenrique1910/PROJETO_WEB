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