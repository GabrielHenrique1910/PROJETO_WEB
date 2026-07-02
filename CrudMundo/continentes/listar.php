<?php
// Inclui a conexão (subindo uma pasta para achar a pasta 'includes')
include '../includes/conexao.php';

// Busca todos os continentes
 $sql = "SELECT * FROM continentes";
 $resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Continentes - CRUD Mundo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Gerenciamento de Continentes</p>
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
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <h2>Lista de Continentes</h2>
        <a href="cadastrar.php" class="btn btn-success">+ Novo Continente</a>

        <!-- Mensagem de sucesso ao cadastrar/editar -->
        <?php if (isset($_GET['msg'])) { ?>
            <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
        <?php } ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>População</th>
                    <th>Área (km²)</th>
                    <th>Total de Países</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo $linha['id_continente']; ?></td>
                    <td><?php echo $linha['nome']; ?></td>
                    <td><?php echo $linha['populacao']; ?></td>
                    <td><?php echo $linha['area']; ?></td>
                    <td><?php echo $linha['total_paises']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $linha['id_continente']; ?>" class="btn btn-warning">Editar</a>
                        <!-- O botão de excluir chama a função JS -->
                        <button onclick="confirmarExclusao(<?php echo $linha['id_continente']; ?>, '<?php echo $linha['nome']; ?>', 'continente')" class="btn btn-danger">Excluir</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <footer class="rodape">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> CRUD Mundo</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>