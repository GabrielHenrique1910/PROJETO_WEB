# CRUD Mundo

Aplicação web para gerenciamento de informações geográficas. Permite administrar continentes, países, cidades e governantes, além de exibir no Google Maps a localização da Etec Prof. Ilza Nascimento Pintus.

## Sobre o projeto

O CRUD Mundo foi desenvolvido como uma aplicação web com interface em HTML, CSS e JavaScript, processamento em PHP e armazenamento de dados em MySQL.

O sistema reúne operações de cadastro, consulta, edição e exclusão de registros. Também possui autenticação de usuários, controle de tentativas de login, troca de senha e registro de ações em logs.

## Funcionalidades

- Login e logout de usuários.
- Bloqueio da conta após três tentativas de senha incorretas.
- Troca obrigatória da senha no primeiro acesso.
- Alteração de senha com confirmação da senha atual.
- Cadastro, listagem, edição e exclusão de continentes.
- Cadastro, listagem, edição e exclusão de países.
- Cadastro, listagem, edição e exclusão de cidades associadas a países.
- Cadastro, listagem, edição e exclusão de governantes associados a países.
- Registro de ações de autenticação e alteração de senha em logs.
- Visualização interativa da localização da Etec Prof. Ilza Nascimento Pintus usando a Google Maps JavaScript API.

## Tecnologias utilizadas

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Google Maps JavaScript API
- Git e GitHub

## Requisitos

- PHP com a extensão MySQLi habilitada.
- MySQL ou MariaDB.
- Servidor web local, como XAMPP ou WampServer.
- Navegador com acesso à internet para carregar o Google Maps.
- Projeto e chave da Google Maps JavaScript API configurados no Google Cloud.

## Estrutura do projeto

```text
CrudMundo/
├── cidades/                 # Cadastro, listagem, edição e exclusão de cidades
├── config/
│   └── google_maps.php      # Carrega a chave do Google Maps do arquivo .env
├── continentes/             # CRUD de continentes
├── css/
│   ├── mapa.css             # Estilos específicos da página do mapa
│   └── style.css            # Estilos gerais
├── database/
│   └── bd_mundo.sql         # Criação e dados iniciais do banco
├── governantes/             # CRUD de governantes
├── includes/
│   ├── auth.php             # Verificação de autenticação
│   └── conexao.php          # Conexão com o banco de dados
├── js/
│   └── script.js            # Interações JavaScript
├── paises/                  # CRUD de países
├── .env.example             # Modelo das variáveis de ambiente
├── .gitignore               # Arquivos que não devem ser enviados ao Git
├── alterar_senha.php        # Alteração de senha
├── index.php                # Página inicial
├── login.php                # Autenticação
├── logout.php               # Encerramento da sessão
├── mapa.php                 # Mapa da localização da ETEC
└── trocar_senha.php         # Troca de senha no primeiro acesso
```

## Banco de dados

O script `database/bd_mundo.sql` cria o banco `bd_mundo` e suas tabelas:

- `continentes`
- `paises`
- `cidades`
- `governantes`
- `usuarios`
- `logs`

Os países estão relacionados a continentes e governantes. As cidades estão relacionadas a países. Os logs podem estar associados a um usuário.

## Como executar localmente

### 1. Instale e inicie o ambiente

Instale o XAMPP ou outro ambiente que ofereça PHP e MySQL. Inicie os serviços **Apache** e **MySQL**.

### 2. Coloque o projeto na pasta do servidor

No XAMPP, copie a pasta `CrudMundo` para:

```text
C:\xampp\htdocs\CrudMundo
```

### 3. Crie o banco de dados

1. Acesse `http://localhost/phpmyadmin`.
2. Importe o arquivo `CrudMundo/database/bd_mundo.sql`.

O script cria o banco de dados `bd_mundo`.

### 4. Configure as variáveis de ambiente

Na pasta `CrudMundo`, faça uma cópia de `.env.example` e nomeie a cópia `.env`. O arquivo `.env` deve ficar na raiz de `CrudMundo`, ao lado de `.env.example`.

Preencha as configurações do banco de dados conforme o seu ambiente e substitua o valor de exemplo da chave:

```ini
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=bd_mundo
GOOGLE_MAPS_API_KEY=SUA_CHAVE_API
```

O arquivo `.env` é local e não deve ser enviado ao GitHub. O arquivo `.env.example` contém apenas valores de exemplo.

### 5. Configure o Google Maps

1. No Google Cloud Console, selecione ou crie um projeto.
2. Ative a **Maps JavaScript API**.
3. Crie uma chave de API.
4. Configure as restrições da chave para permitir somente a API necessária e os endereços usados para testar, como `http://localhost/*`.
5. Coloque a chave no campo `GOOGLE_MAPS_API_KEY` do arquivo `.env`.

A configuração de faturamento pode ser solicitada pelo Google Cloud. Verifique as condições da conta e as cotas aplicáveis. A chave usada pelo mapa fica visível no navegador; por isso, as restrições da chave são importantes.

### 6. Acesse o sistema

Abra:

```text
http://localhost/CrudMundo
```

Acesse o item **Mapa da ETEC** no menu para visualizar o mapa.

O SQL inclui um usuário administrador inicial para o primeiro acesso. A senha inicial está indicada no próprio arquivo `database/bd_mundo.sql`; o sistema solicita sua alteração no primeiro login.

## Segurança e configuração

- Não envie o arquivo `.env` ao GitHub.
- Não coloque uma chave real no `.env.example`.
- Restrinja a chave do Google Maps no Google Cloud.
- Cada ambiente de execução precisa configurar seu próprio `.env`.
- A página do mapa utiliza coordenadas definidas no código para apontar para a sede da ETEC.

## Autor

Desenvolvido por **Gabriel Henrique da Silva**, estudante do curso de Desenvolvimento de Sistemas da Etec Prof. Ilza Nascimento Pintus.
