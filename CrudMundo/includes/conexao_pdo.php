<?php
$arquivoEnv = __DIR__ . '/../.env';
$variaveisEnv = is_file($arquivoEnv) ? parse_ini_file($arquivoEnv) : false;

if ($variaveisEnv === false) {
    http_response_code(500);
    exit('Arquivo .env não encontrado. Copie .env.example para .env e configure o banco.');
}

$servidor = $variaveisEnv['DB_HOST'] ?? 'localhost';
$banco = $variaveisEnv['DB_NAME'] ?? 'bd_mundo';
$usuario = $variaveisEnv['DB_USER'] ?? 'root';
$senha = $variaveisEnv['DB_PASS'] ?? '';

try {
    $pdo = new PDO(
        "mysql:host={$servidor};dbname={$banco};charset=utf8mb4",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $erro) {
    error_log($erro->getMessage());
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados. Confira as configurações do .env.');
}
