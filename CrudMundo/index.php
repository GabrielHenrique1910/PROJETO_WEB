<?php include 'includes/auth.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mundo - Sistema de Gerenciamento</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Sistema de Gerenciamento de Informações Geográficas</p>
        </div>
    </header>

    <nav class="menu-navegacao">
        <div class="container">
            <ul>
                <li><a href="index.php" class="ativo">Início</a></li>
                <li><a href="continentes/listar.php">Continentes</a></li>
                <li><a href="paises/listar.php">Países</a></li>
                <li><a href="cidades/listar.php">Cidades</a></li>
                <li><a href="governantes/listar.php">Governantes</a></li>
                <!-- Botão de Sair adicionado abaixo -->
                <li><a href="logout.php" style="background-color: #c0392b; color: white; border-radius: 5px;">Sair</a></li>
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <section class="boas-vindas">
            <h2>Bem-vindo ao Sistema!</h2>
            <p>Use o menu acima para navegar entre as opções de gerenciamento. Você pode cadastrar, editar, listar e excluir registros de continentes, países, cidades e governantes.</p>
            
            <div class="cards-info">
                <div class="card">
                    <h3>🗺️ Continentes</h3>
                    <p>Gerencie as informações dos continentes do mundo.</p>
                </div>
                <div class="card">
                    <h3>🏳️ Países</h3>
                    <p>Cadastre países e associe a continentes e governantes.</p>
                </div>
                <div class="card">
                    <h3>🏙️ Cidades</h3>
                    <p>Adicione cidades vinculadas a seus respectivos países.</p>
                </div>
                <div class="card">
                    <h3>👑 Governantes</h3>
                    <p>Mantenha o registro dos governantes e seus mandatos.</p>
                </div>
            </div>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>
</html>