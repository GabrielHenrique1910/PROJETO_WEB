# 🌍 CRUD Mundo

Sistema web para gerenciamento de informações geográficas, permitindo o controle de Continentes, Países, Cidades e Governantes. Desenvolvido com foco em segurança, o sistema conta com autenticação de usuários, auditoria (logs) e proteção contra ataques de força bruta.

## 🚀 Funcionalidades

* **Autenticação e Segurança:**
  * Login seguro com verificação de senhas criptografadas (bcrypt).
  * Bloqueio automático de conta após 3 tentativas erradas de login.
  * Troca de senha obrigatória no primeiro acesso.
  * Proteção de rotas utilizando controle de sessão em todas as páginas.
* **Auditoria:** Registro (log) no banco de dados das ações de entrada, erros de senha e atualizações de credenciais, gravando o IP de origem.
* **Módulos CRUD (Create, Read, Update, Delete):**
  * Gerenciamento de Continentes.
  * Gerenciamento de Governantes.
  * Gerenciamento de Países (com chave estrangeira para Continentes e Governantes).
  * Gerenciamento de Cidades (com alerta em JavaScript e exclusão em cascata vinculada aos Países).

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP (integração via `mysqli`)
* **Front-end:** HTML5, CSS3, JavaScript puro
* **Banco de Dados:** MySQL
* **Estilização:** CSS customizado (sem frameworks)

## ⚙️ Como executar o projeto

1. Certifique-se de ter um servidor local rodando (como XAMPP, WAMP ou Laragon).
2. Coloque a pasta do projeto dentro do diretório público do servidor (ex: pasta `htdocs` no XAMPP).
3. Acesse o phpMyAdmin e importe o script `bd_mundo.sql` para criar o banco de dados e as tabelas necessárias.
4. Verifique se as credenciais do seu banco de dados local batem com as do arquivo `includes/conexao.php`.
5. Acesse o projeto no navegador (ex: `http://localhost/crud_mundo/login.php`).

**Credenciais padrão para o primeiro acesso:**
* **E-mail:** admin@mundo.com
* **Senha:** 123456
