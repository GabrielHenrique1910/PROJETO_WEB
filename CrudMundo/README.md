# CRUD Mundo

Sistema web para gerenciamento de dados geográficos mundiais: continentes, países, cidades e governantes, com autenticação de usuários e registro de logs.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)

---

## Sobre o projeto

O CRUD Mundo é uma aplicação web destinada ao gerenciamento de dados geográficos mundiais. Através dela é possível cadastrar, consultar, atualizar e excluir continentes, países, cidades e governantes.

O acesso é restrito a usuários autenticados. O sistema controla tentativas de login inválidas (bloqueando a conta após três erros), exige a troca de senha no primeiro acesso e registra as ações principais em logs, com data, hora e IP de origem.

## Funcionalidades

- Autenticação de usuários (login e logout)
- Bloqueio automático de conta após 3 tentativas de senha incorretas
- Troca obrigatória de senha no primeiro acesso
- Alteração de senha pelo próprio usuário, com confirmação da senha atual
- CRUD completo de continentes, países, cidades e governantes
- Registro de logs das ações realizadas no sistema

## Tecnologias utilizadas

- PHP
- MySQL
- HTML / CSS
- JavaScript
- Git e GitHub

## Modelo do banco de dados

O banco de dados é composto por seis tabelas, relacionadas conforme o diagrama abaixo:

```mermaid
erDiagram
    continentes {
        int id_continente PK
        varchar nome
        bigint populacao
        decimal area
        int total_paises
    }
    governantes {
        int id_governante PK
        varchar nome
        varchar partido_politico
        date data_nascimento
        int idade
        date data_inicio_mandato
        date data_fim_mandato
    }
    paises {
        int id_pais PK
        int id_continente FK
        int id_governante FK
        varchar nome
        bigint populacao
        decimal area
        varchar idioma
        varchar clima
        varchar regime_politico
        varchar moeda
    }
    cidades {
        int id_cidade PK
        int id_pais FK
        varchar nome
        bigint populacao
        decimal area
        varchar clima
        date data_fundacao
    }
    usuarios {
        int id PK
        varchar nome
        varchar email
        varchar senha
        int tentativas_invalidas
        tinyint bloqueado
        tinyint primeiro_acesso
    }
    logs {
        int id PK
        int usuario_id FK
        varchar acao
        varchar ip_origem
        timestamp data_hora
    }

    continentes ||--o{ paises : "possui"
    governantes ||--o{ paises : "governa"
    paises ||--o{ cidades : "contem"
    usuarios ||--o{ logs : "gera"
```

## Estrutura do projeto

```text
CrudMundo/
├── index.php              # Página inicial
├── login.php              # Autenticação
├── logout.php             # Encerramento da sessão
├── trocar_senha.php       # Troca obrigatória no primeiro acesso
├── alterar_senha.php      # Alteração voluntária de senha
├── .env.example           # Modelo das variáveis de ambiente
├── continentes/           # CRUD de continentes
├── paises/                # CRUD de países
├── cidades/               # CRUD de cidades
├── governantes/           # CRUD de governantes
├── css/                   # Folhas de estilo
├── js/                    # Scripts
├── includes/              # Conexão com o banco e autenticação
└── database/              # Script SQL do banco de dados
```

## Como executar

**Requisitos:** PHP, MySQL e um servidor local como XAMPP ou WampServer.

1. Baixe ou clone o repositório
2. Copie a pasta `CrudMundo` para a pasta do servidor local (`htdocs`, no caso do XAMPP)
3. Importe o arquivo `database/bd_mundo.sql` pelo phpMyAdmin
4. Crie o arquivo `.env` na raiz do projeto com base no `.env.example`
5. Inicie os serviços Apache e MySQL
6. Acesse `http://localhost/CrudMundo` no navegador

> **Nota:** o arquivo `.env` não é versionado, pois contém os dados de conexão
> com o banco. Cada ambiente de execução deve ter o seu próprio.

## Autor

Desenvolvido por **Gabriel Henrique da Silva** — Desenvolvimento de Sistemas, ETEC Profº Ilxa Nascimento Pinntus.
