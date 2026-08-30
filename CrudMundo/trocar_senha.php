<?php
session_start();
include 'includes/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nova = $_POST['nova_senha'];
    $confirma = $_POST['confirma_senha'];

    if ($nova === $confirma) {
        $hash = password_hash($nova, PASSWORD_DEFAULT);
        $id = $_SESSION['usuario_id'];
        
        mysqli_query($conexao, "UPDATE usuarios SET senha = '$hash', primeiro_acesso = 0 WHERE id = $id");
        $ip = $_SERVER['REMOTE_ADDR'];
        mysqli_query($conexao, "INSERT INTO logs (usuario_id, acao, ip_origem) VALUES ($id, 'Trocou senha de primeiro acesso', '$ip')");

        header("Location: index.php");
        exit;
    } else {
        $erro = "As senhas não coincidem!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Troca de Senha</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-box" style="margin-top: 100px;">
        <h2 style="text-align:center;">Primeiro Acesso</h2>
        <p style="text-align:center;">É obrigatório cadastrar uma nova senha.</p>
        <?php if($erro): ?><div class="alert alert-error"><?php echo $erro; ?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Nova Senha:</label>
                <input type="password" name="nova_senha" required>
            </div>
            <div class="form-group">
                <label>Confirmar Nova Senha:</label>
                <input type="password" name="confirma_senha" required>
            </div>
            <button type="submit" class="btn btn-success" style="width:100%;">Salvar Senha</button>
        </form>
    </div>
</body>
</html>