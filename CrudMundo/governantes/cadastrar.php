<?php
include '../includes/auth.php';
include '../includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $partido = $_POST['partido_politico'];
    $data_nasc = $_POST['data_nascimento'];
    $idade = $_POST['idade'];
    $inicio = $_POST['data_inicio_mandato'];
    $fim = $_POST['data_fim_mandato'];

    $sql = "INSERT INTO governantes (nome, partido_politico, data_nascimento, idade, data_inicio_mandato, data_fim_mandato) 
            VALUES ('$nome', '$partido', '$data_nasc', '$idade', '$inicio', '$fim')";
    
    if (mysqli_query($conexao, $sql)) {
        header("Location: listar.php?msg=Governante cadastrado com sucesso!");
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Governante</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Cadastrar Novo Governante</p>
        </div>
    </header>

    <nav class="menu-navegacao">
        <div class="container">
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="../continentes/listar.php">Continentes</a></li>
                <li><a href="../paises/listar.php">Países</a></li>
                <li><a href="../cidades/listar.php">Cidades</a></li>
                <li><a href="listar.php" class="ativo">Governantes</a></li>

                <!-- Botão de Mudar Senha -->
                <li><a href="../alterar_senha.php">Mudar Senha</a></li>
                
                <!-- Botão de Sair com ../ adicionado abaixo -->
                <li><a href="../logout.php" style="background-color: #c0392b; color: white; border-radius: 5px;">Sair</a></li>
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <h2>Novo Governante</h2>
        
        <div class="form-box">
            <form action="cadastrar.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome do Governante:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="partido_politico">Partido Político:</label>
                    <input type="text" id="partido_politico" name="partido_politico" required>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required>
                </div>
                <div class="form-group">
                    <label for="idade">Idade:</label>
                    <input type="number" id="idade" name="idade" required>
                </div>
                <div class="form-group">
                    <label for="data_inicio_mandato">Início do Mandato:</label>
                    <input type="date" id="data_inicio_mandato" name="data_inicio_mandato" required>
                </div>
                <div class="form-group">
                    <label for="data_fim_mandato">Fim do Mandato:</label>
                    <input type="date" id="data_fim_mandato" name="data_fim_mandato" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="listar.php" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </main>

    <footer class="rodape">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> CRUD Mundo</p>
        </div>
    </footer>
</body>
</html>