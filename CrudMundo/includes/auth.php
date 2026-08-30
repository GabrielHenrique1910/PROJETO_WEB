<?php
session_start();
// Verifica se o usuário NÃO está logado
if (!isset($_SESSION['usuario_id'])) {
    // Descobre se estamos na raiz (index) ou dentro de uma subpasta (cidades, etc)
    $caminho_login = (basename($_SERVER['PHP_SELF']) === 'index.php') ? 'login.php' : '../login.php';
    header("Location: $caminho_login");
    exit;
}
?>