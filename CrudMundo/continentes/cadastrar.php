<?php
include '../includes/auth.php';
include '../includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $populacao = $_POST['populacao'];
    $area = $_POST['area'];
    $total_paises = $_POST['total_paises'];

    $sql = "INSERT INTO continentes (nome, populacao, area, total_paises) 
            VALUES ('$nome', '$populacao', '$area', '$total_paises')";
    
    if (mysqli_query($conexao, $sql)) {
        header("Location: listar.php?msg=Continente cadastrado com sucesso!");
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
    <title>Cadastrar Continente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Cadastrar Novo Continente</p>
        </div>
    </header>

    <nav class="menu-navegacao">
        <div class="container">
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="listar.php" class="ativo">Continentes</a></li>
                <li><a href="../paises/listar.php">Países</a></li>
                <li><a href="../cidades/listar.php">Cidades</a></li>
                <li><a href="../governantes/listar.php">Governantes</a></li>
                <!-- Botão de Sair com ../ adicionado abaixo -->
                <li><a href="../logout.php" style="background-color: #c0392b; color: white; border-radius: 5px;">Sair</a></li>
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <h2>Novo Continente</h2>
        
        <div class="form-box">
            <form action="cadastrar.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome do Continente:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="populacao">População Total:</label>
                    <input type="number" id="populacao" name="populacao" required>
                </div>
                <div class="form-group">
                    <label for="area">Área (km²):</label>
                    <input type="number" step="0.01" id="area" name="area" required>
                </div>
                <div class="form-group">
                    <label for="total_paises">Total de Países:</label>
                    <input type="number" id="total_paises" name="total_paises" required>
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