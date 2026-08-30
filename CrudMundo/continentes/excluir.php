<?php
include '../includes/auth.php';
include '../includes/conexao.php';

// Pega o ID passado pelo JavaScript
 $id = $_GET['id'];

// Deleta o continente (O banco está configurado para apagar países e cidades junto em cascata)
 $sql = "DELETE FROM continentes WHERE id_continente = $id";

if (mysqli_query($conexao, $sql)) {
    header("Location: listar.php?msg=Continente excluído com sucesso!");
} else {
    echo "Erro ao excluir: " . mysqli_error($conexao);
}
?>