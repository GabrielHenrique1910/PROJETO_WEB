<?php
include '../includes/auth.php';
include '../includes/conexao.php';

 $id = $_GET['id'];

 $sql = "DELETE FROM governantes WHERE id_governante = $id";

if (mysqli_query($conexao, $sql)) {
    header("Location: listar.php?msg=Governante excluído com sucesso!");
} else {
    echo "Erro ao excluir: " . mysqli_error($conexao);
}
?>