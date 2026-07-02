<?php
// Define os parâmetros de conexão com o banco de dados
 $servidor = "localhost";
 $usuario = "root"; // Usuário padrão do XAMPP
 $senha = "";       // Senha padrão do XAMPP (vazia)
 $banco = "bd_mundo";

// Cria a conexão usando mysqli
 $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if (!$conexao) {
    die("Erro de conexão com o banco de dados: " . mysqli_connect_error());
}

// Define o charset como utf8mb4 para evitar problemas com acentos
mysqli_set_charset($conexao, "utf8mb4");
?>