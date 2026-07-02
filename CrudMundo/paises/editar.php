<?php
include '../includes/conexao.php';

 $id = $_GET['id'];

// Busca os dados do país
 $sql_busca = "SELECT * FROM paises WHERE id_pais = $id";
 $resultado_busca = mysqli_query($conexao, $sql_busca);
 $pais = mysqli_fetch_assoc($resultado_busca);

// Busca listas para os selects
 $continentes = mysqli_query($conexao, "SELECT * FROM continentes ORDER BY nome ASC");
 $governantes = mysqli_query($conexao, "SELECT * FROM governantes ORDER BY nome ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $id_continente = $_POST['id_continente'];
    $id_governante = $_POST['id_governante'];
    $populacao = $_POST['populacao'];
    $area = $_POST['area'];
    $idioma = $_POST['idioma'];
    $clima = $_POST['clima'];
    $regime = $_POST['regime_politico'];
    $moeda = $_POST['moeda'];

    $sql_update = "UPDATE paises SET 
                   nome='$nome', id_continente='$id_continente', id_governante='$id_governante', 
                   populacao='$populacao', area='$area', idioma='$idioma', clima='$clima', 
                   regime_politico='$regime', moeda='$moeda' 
                   WHERE id_pais=$id";
    
    if (mysqli_query($conexao, $sql_update)) {
        header("Location: listar.php?msg=País atualizado com sucesso!");
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conexao);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar País</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="cabecalho">
        <div class="container">
            <h1>🌍 CRUD Mundo</h1>
            <p>Editar País</p>
        </div>
    </header>

    <nav class="menu-navegacao">
        <div class="container">
            <ul>
                <li><a href="../index.php">Início</a></li>
                <li><a href="../continentes/listar.php">Continentes</a></li>
                <li><a href="listar.php" class="ativo">Países</a></li>
                <li><a href="../cidades/listar.php">Cidades</a></li>
                <li><a href="../governantes/listar.php">Governantes</a></li>
            </ul>
        </div>
    </nav>

    <main class="container conteudo-principal">
        <h2>Editar País</h2>
        
        <div class="form-box">
            <form action="editar.php?id=<?php echo $id; ?>" method="POST">
                <div class="form-group">
                    <label for="nome">Nome do País:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo $pais['nome']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="id_continente">Continente:</label>
                    <select id="id_continente" name="id_continente" required>
                        <option value="">Selecione...</option>
                        <?php while($cont = mysqli_fetch_assoc($continentes)) { ?>
                            <option value="<?php echo $cont['id_continente']; ?>" 
                                <?php if($cont['id_continente'] == $pais['id_continente']) echo 'selected'; ?>>
                                <?php echo $cont['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_governante">Governante:</label>
                    <select id="id_governante" name="id_governante" required>
                        <option value="">Selecione...</option>
                        <?php while($gov = mysqli_fetch_assoc($governantes)) { ?>
                            <option value="<?php echo $gov['id_governante']; ?>" 
                                <?php if($gov['id_governante'] == $pais['id_governante']) echo 'selected'; ?>>
                                <?php echo $gov['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="populacao">População:</label>
                    <input type="number" id="populacao" name="populacao" value="<?php echo $pais['populacao']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="area">Área (km²):</label>
                    <input type="number" step="0.01" id="area" name="area" value="<?php echo $pais['area']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="idioma">Idioma:</label>
                    <input type="text" id="idioma" name="idioma" value="<?php echo $pais['idioma']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="clima">Clima:</label>
                    <input type="text" id="clima" name="clima" value="<?php echo $pais['clima']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="regime_politico">Regime Político:</label>
                    <input type="text" id="regime_politico" name="regime_politico" value="<?php echo $pais['regime_politico']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="moeda">Moeda:</label>
                    <input type="text" id="moeda" name="moeda" value="<?php echo $pais['moeda']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="listar.php" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </main>

    <footer class="rodape">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> CRUD Mundo</p>
        </div>
    </footer>
</body>
</html>