<?php
include '../includes/auth.php';
include '../includes/conexao.php';

 $sql = "SELECT c.*, p.nome AS nome_pais 
        FROM cidades c
        LEFT JOIN paises p ON c.id_pais = p.id_pais
        ORDER BY c.nome ASC";
 $resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cidades - CRUD Mundo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Gerenciamento de Cidades</p>
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
        <h2>Lista de Cidades</h2>
        <a href="cadastrar.php" class="btn btn-success">+ Nova Cidade</a>

        <?php if (isset($_GET['msg'])) { ?>
            <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
        <?php } ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>País</th>
                    <th>População</th>
                    <th>Área (km²)</th>
                    <th>Clima</th>
                    <th>Data de Fundação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = mysqli_fetch_assoc($resultado)) { 
                    // Formata a data para o padrão brasileiro
                    $data_fundacao = !empty($linha['data_fundacao']) ? date('d/m/Y', strtotime($linha['data_fundacao'])) : '';
                ?>
                <tr>
                    <td><?php echo $linha['id_cidade']; ?></td>
                    <td><?php echo $linha['nome']; ?></td>
                    <td><?php echo $linha['nome_pais'] ?? 'Não definido'; ?></td>
                    <td><?php echo $linha['populacao']; ?></td>
                    <td><?php echo $linha['area']; ?></td>
                    <td><?php echo $linha['clima']; ?></td>
                    <td><?php echo $data_fundacao; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $linha['id_cidade']; ?>" class="btn btn-warning">Editar</a>
                        <button onclick="confirmarExclusao(<?php echo $linha['id_cidade']; ?>, '<?php echo $linha['nome']; ?>', 'cidade')" class="btn btn-danger">Excluir</button>
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