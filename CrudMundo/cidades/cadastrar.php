<?php
include '../includes/auth.php';
include '../includes/conexao.php';

// Busca os países para o select
 $paises = mysqli_query($conexao, "SELECT * FROM paises ORDER BY nome ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $id_pais = $_POST['id_pais'];
    $populacao = $_POST['populacao'];
    $area = $_POST['area'];
    $clima = $_POST['clima'];
    $data_fundacao = $_POST['data_fundacao'];

    $sql = "INSERT INTO cidades (nome, id_pais, populacao, area, clima, data_fundacao) 
            VALUES ('$nome', '$id_pais', '$populacao', '$area', '$clima', '$data_fundacao')";
    
    if (mysqli_query($conexao, $sql)) {
        header("Location: listar.php?msg=Cidade cadastrada com sucesso!");
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
    <title>Cadastrar Cidade</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Cadastrar Nova Cidade</p>
        </div>
    </header>

    <nav class="menu-navegacao">
        <div class="container">
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="../continentes/listar.php">Continentes</a></li>
                <li><a href="../paises/listar.php">Países</a></li>
                <li><a href="listar.php" class="ativo">Cidades</a></li>
                <li><a href="../governantes/listar.php">Governantes</a></li>

                <!-- Botão de Mudar Senha -->
                <li><a href="../alterar_senha.php">Mudar Senha</a></li>
                
                <!-- Botão de Sair com ../ adicionado abaixo -->
                <li><a href="../logout.php" style="background-color: #c0392b; color: white; border-radius: 5px;">Sair</a></li>
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <h2>Nova Cidade</h2>
        
        <div class="form-box">
            <form action="cadastrar.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome da Cidade:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="id_pais">País:</label>
                    <select id="id_pais" name="id_pais" required>
                        <option value="">Selecione...</option>
                        <?php while($pais = mysqli_fetch_assoc($paises)) { ?>
                            <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['nome']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="populacao">População:</label>
                    <input type="number" id="populacao" name="populacao" required>
                </div>
                <div class="form-group">
                    <label for="area">Área (km²):</label>
                    <input type="number" step="0.01" id="area" name="area" required>
                </div>
                <div class="form-group">
                    <label for="clima">Clima:</label>
                    <input type="text" id="clima" name="clima" required>
                </div>
                <div class="form-group">
                    <label for="data_fundacao">Data de Fundação:</label>
                    <input type="date" id="data_fundacao" name="data_fundacao" required>
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