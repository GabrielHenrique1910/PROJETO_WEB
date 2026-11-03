<?php include '../includes/auth.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar país pela API - CRUD Mundo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Importação de países pela REST Countries API</p>
        </div>
    </header>

    <nav class="menu-navegacao">
        <div class="container">
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="../continentes/listar.php">Continentes</a></li>
                <li><a href="listar.php" class="ativo">Países</a></li>
                <li><a href="../cidades/listar.php">Cidades</a></li>
                <li><a href="../governantes/listar.php">Governantes</a></li>
                <li><a href="../mapa.php">Mapa da ETEC</a></li>
                <li><a href="../alterar_senha.php">Mudar Senha</a></li>
                <li><a href="../logout.php" style="background-color: #c0392b; color: white; border-radius: 5px;">Sair</a></li>
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <h2>Importar país da API</h2>
        <p>Informe o nome comum do país em português ou inglês. Os dados encontrados serão gravados no banco de dados.</p>

        <div class="form-box">
            <form action="importar_pais.php" method="POST">
                <div class="form-group">
                    <label for="pais">Nome do país:</label>
                    <input
                        type="text"
                        id="pais"
                        name="pais"
                        maxlength="100"
                        placeholder="Ex.: Brazil, Brasil, Japan"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Consultar e cadastrar</button>
                <a href="listar.php" class="btn btn-danger">Voltar aos países</a>
            </form>
        </div>

        <p style="text-align: center; margin-top: 20px;">
            A consulta é feita à REST Countries API usando PHP e cURL. O cadastro local é executado com PDO.
        </p>
        <p class="alert" style="background-color: #f39c12;">
            A chave de demonstração pode retornar um país de exemplo, independentemente do nome pesquisado.
            Para importar o país correspondente à busca, configure uma chave própria no arquivo .env.
        </p>
    </main>

    <footer class="rodape">
        <div class="container">
            <p>&copy; <?= date('Y') ?> CRUD Mundo</p>
        </div>
    </footer>
</body>
</html>
