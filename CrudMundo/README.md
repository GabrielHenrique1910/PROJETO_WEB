<div align="center">

# 🌍 CRUD Mundo

**Sistema web para gerenciamento de dados geográficos mundiais**

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)]()
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)]()
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)]()
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)]()
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)]()
[![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)]()

</div>

---

## 📖 Sobre o projeto

O CRUD Mundo é uma aplicação web destinada ao gerenciamento de dados geográficos mundiais, permitindo o cadastro, a consulta, a atualização e a exclusão de **continentes**, **países**, **cidades** e **governantes**.

O sistema conta com autenticação de usuários, bloqueio de conta após tentativas inválidas de login, troca obrigatória de senha no primeiro acesso e registro de logs com data, hora e IP de origem.

## ✨ Funcionalidades

- 🔐 Login e logout de usuários
- 🚫 Bloqueio de conta após 3 tentativas de senha incorretas
- 🔑 Troca obrigatória de senha no primeiro acesso
- 👤 Alteração voluntária de senha com validação da senha atual
- 🌐 CRUD completo de continentes
- 🏳️ CRUD completo de países
- 🏙️ CRUD completo de cidades
- 👑 CRUD completo de governantes
- 📋 Registro de logs de ações do usuário

## 🗄️ Modelo do banco de dados

```mermaid
erDiagram
    continentes ||--o{ paises : possui
    governantes ||--o{ paises : governa
    paises ||--o{ cidades : contem
    usuarios ||--o{ logs : gera
```

## 🛠️ Tecnologias utilizadas

- PHP
- MySQL
- HTML
- CSS
- JavaScript
- Git / GitHub

## 📁 Estrutura do projeto

| Pasta / Arquivo | Descrição |
|---|---|
| `index.php` | Página inicial do sistema |
| `login.php` / `logout.php` | Autenticação do usuário |
| `trocar_senha.php` | Troca obrigatória de senha no primeiro acesso |
| `alterar_senha.php` | Alteração voluntária de senha |
| `continentes/` | CRUD de continentes |
| `paises/` | CRUD de países |
| `cidades/` | CRUD de cidades |
| `governantes/` | CRUD de governantes |
| `css/` | Folhas de estilo |
| `js/` | Scripts JavaScript |
| `includes/` | Autenticação e conexão com o banco |
| `database/` | Script SQL do banco de dados |
| `.env.example` | Modelo das variáveis de ambiente |

## ⚙️ Requisitos

- PHP
- MySQL
- Servidor local (XAMPP, WampServer ou similar)
- Navegador

## 🚀 Como executar

1. Clone o repositório ou baixe o ZIP
2. Copie a pasta `CrudMundo` para a pasta do servidor local (ex.: `htdocs` no XAMPP)
3. Crie o arquivo `.env` na raiz do projeto com base no `.env.example`
4. Inicie os serviços Apache e MySQL
5. Importe o arquivo `database/bd_mundo.sql` pelo phpMyAdmin
6. Acesse `http://localhost/CrudMundo` no navegador

---

<div align="center">

**👤 Autor**

Seu Nome Completo — Desenvolvimento de Sistemas | ETEC ETECOS

</div>
