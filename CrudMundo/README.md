# 🌍 CRUD Mundo

<p align="center">
  <strong>Gerenciamento de informações geográficas com PHP, MySQL e APIs externas</strong><br>
  Cadastre e consulte dados de continentes, países, cidades e governantes — e importe dados de países pela REST Countries API.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white" alt="HTML5">
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white" alt="CSS3">
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black" alt="JavaScript">
  <img src="https://img.shields.io/badge/Google%20Maps-4285F4?style=flat-square&logo=googlemaps&logoColor=white" alt="Google Maps">
  <img src="https://img.shields.io/badge/REST%20Countries-API-2D6A4F?style=flat-square" alt="REST Countries API">
</p>

---

## 📑 Navegação

[Sobre](#-sobre-o-projeto) · [Funcionalidades](#-funcionalidades) · [Tecnologias](#-tecnologias) · [Estrutura](#-estrutura-do-projeto) · [Banco de dados](#-modelo-do-banco-de-dados) · [Instalação](#-como-executar) · [APIs](#-integrações-com-apis) · [Segurança](#-segurança) · [Autor](#-autor)

## 📖 Sobre o projeto

O **CRUD Mundo** é uma aplicação web para gerenciar informações geográficas. Além das operações de cadastro, consulta, edição e exclusão, o sistema possui autenticação de usuários, controle de tentativas de login, alteração de senha e registro de ações.

A funcionalidade de importação de países demonstra a integração entre uma aplicação PHP e um serviço externo: o sistema consulta a **REST Countries API** via HTTP GET, interpreta a resposta JSON e grava os dados selecionados no banco MySQL com uma instrução parametrizada via PDO.

A aplicação também apresenta um mapa da localização da **Etec Prof. Ilza Nascimento Pintus**, em São José dos Campos, usando a Google Maps JavaScript API.

## ✨ Funcionalidades

### CRUD Mundo

- Cadastro, listagem, edição e exclusão de continentes.
- Cadastro, listagem, edição e exclusão de países.
- Cadastro, listagem, edição e exclusão de cidades associadas a países.
- Cadastro, listagem, edição e exclusão de governantes.
- Relacionamentos entre continentes, países, cidades e governantes.

### Autenticação

- Login e logout.
- Bloqueio da conta após três tentativas de senha incorretas.
- Troca obrigatória de senha no primeiro acesso.
- Alteração de senha com confirmação da senha atual.
- Registro de ações de autenticação e alteração de senha em logs.

### Importação via REST Countries API

- Busca de um país pelo nome comum.
- Consulta remota via HTTP GET com cURL.
- Interpretação e validação da resposta JSON.
- Verificação de duplicidade pelo código ISO alpha-2.
- Gravação no MySQL com PDO e parâmetros preparados.
- Exibição dos países importados na listagem de países.

Os campos importados são nome comum, código ISO alpha-2, capital, população, região e sub-região. Como esses dados não incluem o continente cadastrado nem o governante, os relacionamentos correspondentes permanecem sem associação até serem definidos no CRUD.

### Mapa

- Mapa interativo com marcador na localização da Etec Prof. Ilza Nascimento Pintus.
- Coordenadas fixas no código da página do mapa para fins da atividade.

## 🧰 Tecnologias

| Tecnologia | Uso no projeto |
|---|---|
| PHP | Lógica de servidor e processamento de formulários |
| MySQL | Persistência e relacionamento dos dados |
| MySQLi | Conexão utilizada pelos módulos CRUD existentes |
| PDO | Conexão e INSERT parametrizado na importação via API |
| cURL | Requisição HTTP à REST Countries API |
| JSON | Formato da resposta recebida da API |
| HTML5 e CSS3 | Estrutura e apresentação da interface |
| JavaScript | Interações da interface e inicialização do mapa |
| Google Maps JavaScript API | Mapa interativo da ETEC |

## 🗂️ Estrutura do projeto

```text
CrudMundo/
├── cidades/                         # CRUD de cidades
├── config/
│   ├── api.php                       # Chave da REST Countries lida do .env
│   └── google_maps.php               # Chave do Google Maps lida do .env
├── continentes/                      # CRUD de continentes
├── css/
│   ├── mapa.css                      # Estilos específicos do mapa
│   └── style.css                     # Estilos gerais
├── database/
│   ├── bd_mundo.sql                  # Estrutura inicial e dados do banco
│   └── migracao_api_countries.sql    # Colunas necessárias à importação pela API
├── governantes/                      # CRUD de governantes
├── includes/
│   ├── auth.php                      # Proteção das páginas autenticadas
│   ├── conexao.php                   # Conexão MySQLi usada pelo CRUD existente
│   └── conexao_pdo.php               # Conexão PDO usada pela importação
├── js/
│   └── script.js                     # Interações JavaScript
├── paises/
│   ├── importar.php                  # Formulário de busca na API
│   ├── importar_pais.php             # Consulta API, valida e grava com PDO
│   └── ...                           # Demais páginas do CRUD de países
├── .env.example                      # Modelo das configurações locais
├── .gitignore                        # Arquivos locais ignorados pelo Git
├── index.php                         # Página inicial
└── mapa.php                          # Mapa da ETEC
