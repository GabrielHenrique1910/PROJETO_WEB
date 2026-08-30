<?php
session_start();
include 'includes/conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $sql);
    
    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        if ($usuario['bloqueado'] == 1) {
            $erro = "Usuário bloqueado por 3 tentativas falhas. Contate o suporte.";
        } else {
            // Verifica a senha criptografada
            if (password_verify($senha, $usuario['senha'])) {
                // Zera as tentativas e salva o log
                mysqli_query($conexao, "UPDATE usuarios SET tentativas_invalidas = 0 WHERE id = " . $usuario['id']);
                $ip = $_SERVER['REMOTE_ADDR'];
                mysqli_query($conexao, "INSERT INTO logs (usuario_id, acao, ip_origem) VALUES (".$usuario['id'].", 'Login efetuado', '$ip')");

                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                // Redireciona se for o primeiro acesso
                if ($usuario['primeiro_acesso'] == 1) {
                    header("Location: trocar_senha.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                // Lógica de bloqueio: +1 tentativa
                $tentativas = $usuario['tentativas_invalidas'] + 1;
                $bloqueado = ($tentativas >= 3) ? 1 : 0;
                
                mysqli_query($conexao, "UPDATE usuarios SET tentativas_invalidas = $tentativas, bloqueado = $bloqueado WHERE id = " . $usuario['id']);
                $ip = $_SERVER['REMOTE_ADDR'];
                mysqli_query($conexao, "INSERT INTO logs (usuario_id, acao, ip_origem) VALUES (".$usuario['id'].", 'Senha incorreta', '$ip')");

                if ($bloqueado) {
                    $erro = "Sua conta foi BLOQUEADA por atingir 3 tentativas erradas!";
                } else {
                    $erro = "Senha incorreta. Você tem mais " . (3 - $tentativas) . " tentativa(s).";
                }
            }
        }
    } else {
        $erro = "E-mail não encontrado no sistema.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - CRUD Mundo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-box" style="margin-top: 100px;">
        <h2 style="text-align:center;">Login do Sistema</h2>
        <?php if($erro): ?><div class="alert alert-error"><?php echo $erro; ?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>E-mail:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Senha:</label>
                <input type="password" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Entrar</button>
        </form>
    </div>
</body>
</html>