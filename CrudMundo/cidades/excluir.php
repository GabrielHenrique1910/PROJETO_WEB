<?php
include '../includes/conexao.php';

 $id = $_GET['id'];

 $sql = "DELETE FROM cidades WHERE id_cidade = $id";

if (mysqli_query($conexao, $sql)) {
    header("Location: listar.php?msg=Cidade excluída com sucesso!");
} else {
    echo "Erro ao excluir: " . mysqli_error($conexao);
}
?>