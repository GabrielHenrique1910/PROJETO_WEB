<?php
include '../includes/conexao.php';

 $sql = "SELECT * FROM governantes ORDER BY nome ASC";
 $resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Governantes - CRUD Mundo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Gerenciamento de Governantes</p>
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
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <h2>Lista de Governantes</h2>
        <a href="cadastrar.php" class="btn btn-success">+ Novo Governante</a>

        <?php if (isset($_GET['msg'])) { ?>
            <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
        <?php } ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Partido</th>
                    <th>Nascimento</th>
                    <th>Idade</th>
                    <th>Início Mandato</th>
                    <th>Fim Mandato</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = mysqli_fetch_assoc($resultado)) { 
                    // Formata a data para o padrão brasileiro
                    $data_nasc = date('d/m/Y', strtotime($linha['data_nascimento']));
                    $inicio = date('d/m/Y', strtotime($linha['data_inicio_mandato']));
                    $fim = date('d/m/Y', strtotime($linha['data_fim_mandato']));
                ?>
                <tr>
                    <td><?php echo $linha['id_governante']; ?></td>
                    <td><?php echo $linha['nome']; ?></td>
                    <td><?php echo $linha['partido_politico']; ?></td>
                    <td><?php echo $data_nasc; ?></td>
                    <td><?php echo $linha['idade']; ?></td>
                    <td><?php echo $inicio; ?></td>
                    <td><?php echo $fim; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $linha['id_governante']; ?>" class="btn btn-warning">Editar</a>
                        <button onclick="confirmarExclusao(<?php echo $linha['id_governante']; ?>, '<?php echo $linha['nome']; ?>', 'governante')" class="btn btn-danger">Excluir</button>
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