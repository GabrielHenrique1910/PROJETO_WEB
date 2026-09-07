<?php
include 'includes/auth.php'; // Garante que só quem está logado acesse
include 'includes/conexao.php';

$mensagem = '';
$tipo_alerta = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirma_senha = $_POST['confirma_senha'];
    $id_usuario = $_SESSION['usuario_id'];

    // Busca a senha atual do usuário no banco
    $sql = "SELECT senha FROM usuarios WHERE id = $id_usuario";
    $resultado = mysqli_query($conexao, $sql);
    $usuario = mysqli_fetch_assoc($resultado);

    // Verifica se a senha atual digitada bate com a do banco
    if (password_verify($senha_atual, $usuario['senha'])) {
        // Verifica se a nova senha e a confirmação são iguais
        if ($nova_senha === $confirma_senha) {
            // Criptografa a nova senha e atualiza no banco
            $hash_nova_senha = password_hash($nova_senha, PASSWORD_DEFAULT);
            $sql_update = "UPDATE usuarios SET senha = '$hash_nova_senha' WHERE id = $id_usuario";
            
            if (mysqli_query($conexao, $sql_update)) {
                $mensagem = "Senha alterada com sucesso!";
                $tipo_alerta = "alert-success";
                
                // Registra no log
                $ip = $_SERVER['REMOTE_ADDR'];
                mysqli_query($conexao, "INSERT INTO logs (usuario_id, acao, ip_origem) VALUES ($id_usuario, 'Alteração voluntária de senha', '$ip')");
            } else {
                $mensagem = "Erro ao atualizar a senha: " . mysqli_error($conexao);
                $tipo_alerta = "alert-error";
            }
        } else {
            $mensagem = "A nova senha e a confirmação não coincidem!";
            $tipo_alerta = "alert-error";
        }
    } else {
        $mensagem = "A senha atual está incorreta!";
        $tipo_alerta = "alert-error";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mudar Senha - CRUD Mundo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Manutenção de Senha</p>
        </div>
    </header>

    <nav class="menu-navegacao">
        <div class="container">
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="continentes/listar.php">Continentes</a></li>
                <li><a href="paises/listar.php">Países</a></li>
                <li><a href="cidades/listar.php">Cidades</a></li>
                <li><a href="governantes/listar.php">Governantes</a></li>
                <li><a href="alterar_senha.php" class="ativo">Mudar Senha</a></li>
                <li><a href="logout.php" style="background-color: #c0392b; color: white; border-radius: 5px;">Sair</a></li>
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <div class="form-box">
            <h2 style="text-align:center;">Alterar Minha Senha</h2>
            
            <?php if($mensagem): ?>
                <div class="alert <?php echo $tipo_alerta; ?>"><?php echo $mensagem; ?></div>
            <?php endif; ?>

            <form method="POST" action="alterar_senha.php">
                <div class="form-group">
                    <label>Senha Atual:</label>
                    <input type="password" name="senha_atual" required>
                </div>
                <div class="form-group">
                    <label>Nova Senha:</label>
                    <input type="password" name="nova_senha" required>
                </div>
                <div class="form-group">
                    <label>Confirmar Nova Senha:</label>
                    <input type="password" name="confirma_senha" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Atualizar Senha</button>
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
