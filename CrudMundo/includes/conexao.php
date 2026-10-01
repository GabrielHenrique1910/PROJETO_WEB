<?php
// Carrega as variáveis de ambiente do arquivo .env (não versionado)
$env = parse_ini_file(__DIR__ . '/../.env');

if ($env === false) {
    die("Arquivo .env não encontrado. Copie o .env.example para .env e configure a conexão.");
}

$servidor = $env['DB_HOST'];
$usuario  = $env['DB_USER'];
$senha    = $env['DB_PASS'];
$banco    = $env['DB_NAME'];

// Cria a conexão usando mysqli
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if (!$conexao) {
    die("Erro de conexão com o banco de dados: " . mysqli_connect_error());
}

// Define o charset como utf8mb4 para evitar problemas com acentos
mysqli_set_charset($conexao, "utf8mb4");
?>
