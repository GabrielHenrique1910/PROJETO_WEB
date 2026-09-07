<?php
include '../includes/auth.php';
include '../includes/conexao.php';

// Faz a junção das tabelas para pegar os nomes
 $sql = "SELECT p.*, c.nome AS nome_continente, g.nome AS nome_governante 
        FROM paises p
        LEFT JOIN continentes c ON p.id_continente = c.id_continente
        LEFT JOIN governantes g ON p.id_governante = g.id_governante";
 $resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Países - CRUD Mundo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Gerenciamento de Países</p>
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

                <!-- Botão de Mudar Senha -->
                <li><a href="../alterar_senha.php">Mudar Senha</a></li>
                
                <!-- Botão de Sair com ../ adicionado abaixo -->
                <li><a href="../logout.php" style="background-color: #c0392b; color: white; border-radius: 5px;">Sair</a></li>
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <h2>Lista de Países</h2>
        <a href="cadastrar.php" class="btn btn-success">+ Novo País</a>

        <?php if (isset($_GET['msg'])) { ?>
            <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
        <?php } ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Continente</th>
                    <th>Governante</th>
                    <th>População</th>
                    <th>Idioma</th>
                    <th>Moeda</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo $linha['id_pais']; ?></td>
                    <td><?php echo $linha['nome']; ?></td>
                    <td><?php echo $linha['nome_continente'] ?? 'Não definido'; ?></td>
                    <td><?php echo $linha['nome_governante'] ?? 'Não definido'; ?></td>
                    <td><?php echo $linha['populacao']; ?></td>
                    <td><?php echo $linha['idioma']; ?></td>
                    <td><?php echo $linha['moeda']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $linha['id_pais']; ?>" class="btn btn-warning">Editar</a>
                        <button onclick="confirmarExclusao(<?php echo $linha['id_pais']; ?>, '<?php echo $linha['nome']; ?>', 'país')" class="btn btn-danger">Excluir</button>
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