<?php
include '../includes/conexao.php';

 $id = $_GET['id'];

 $sql = "DELETE FROM paises WHERE id_pais = $id";

if (mysqli_query($conexao, $sql)) {
    header("Location: listar.php?msg=País (e suas cidades vinculadas) excluído com sucesso!");
} else {
    echo "Erro ao excluir: " . mysqli_error($conexao);
}
?>