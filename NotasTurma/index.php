<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Análise Estatística de Turma</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Análise Estatística de Turma Escolar</h1>

    <?php

    /*
        Recebe os dados informados no formulário.
    */
    $turma = $_POST['turma'] ?? '';
    $qtdAlunos = intval($_POST['qtd_alunos'] ?? 0);

    /*
        Processamento dos resultados
        Após o envio das notas, o sistema percorre todos os alunos, realiza os cálculos individuais e gera o relatório final.
    */
    if (isset($_POST['processar'])) {

        $alunos = [];
        $somaNotasTotal = 0;
        $totalAprovados = 0;
        $totalRecuperacao = 0;
        $totalReprovado = 0;
        $maiorMedia = 0;
        $menorMedia = PHP_INT_MAX;

        /*
            Processamento dos alunos
            O laço percorre todos os alunos cadastrados e calcula média, situação, raiz quadrada e diferença absoluta.
        */
        for ($i = 0; $i < $qtdAlunos; $i++) {

            $nome = trim($_POST["nome_$i"] ?? '');
            $nota1 = floatval($_POST["nota1_$i"] ?? 0);
            $nota2 = floatval($_POST["nota2_$i"] ?? 0);
            $trabalho = floatval($_POST["trabalho_$i"] ?? 0);

            if ($nome == '') {
                $nome = "Aluno " . ($i + 1);
            }

            $media = ($nota1 + $nota2 + $trabalho) / 3;
            $raizQuadrada = sqrt($nota1 + $nota2 + $trabalho);
            $difAbsoluta = abs(max($nota1, $nota2, $trabalho) - min($nota1, $nota2, $trabalho));

            if ($media >= 7) {
                $situacao = "Aprovado";
                $totalAprovados++;
            } elseif ($media >= 5) {
                $situacao = "Recuperação";
                $totalRecuperacao++;
            } else {
                $situacao = "Reprovado";
                $totalReprovado++;
            }

            /*
                Armazenamento dos dados
                Guarda todas as informações calculadas para exibição posterior na tabela de resultados.
            */
            $alunos[] = [
                'nome' => $nome,
                'nota1' => $nota1,
                'nota2' => $nota2,
                'trabalho' => $trabalho,
                'media' => $media,
                'raiz' => $raizQuadrada,
                'difAbs' => $difAbsoluta,
                'situacao' => $situacao
            ];

            $somaNotasTotal += $nota1 + $nota2 + $trabalho;

            if ($media > $maiorMedia) {
                $maiorMedia = $media;
            }

            if ($media < $menorMedia) {
                $menorMedia = $media;
            }
        }

        /*
            Estatísticas da turma
            Calcula os indicadores gerais utilizados no relatório.
        */
        $mediaGeral = $somaNotasTotal / ($qtdAlunos * 3);
        $percentualAprovado = ($totalAprovados / $qtdAlunos) * 100;
    }

    ?>

    <form method="POST">

        <div class="form-group">
            <label>Nome da Turma:</label>
            <input type="text" name="turma"
                   value="<?= htmlspecialchars($turma) ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Quantidade de Alunos:</label>
            <input type="number" name="qtd_alunos"
                   min="1"
                   value="<?= $qtdAlunos ?>"
                   required>
        </div>

        <?php if (isset($_POST['gerar'])): ?>

            <?php for ($i = 0; $i < $qtdAlunos; $i++): ?>

                <div class="estudante">

                    <h3>Aluno <?= $i + 1 ?></h3>

                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="nome_<?= $i ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nota da Prova 1:</label>
                        <input type="number"
                               name="nota1_<?= $i ?>"
                               min="0"
                               max="10"
                               step="0.01"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Nota da Prova 2:</label>
                        <input type="number"
                               name="nota2_<?= $i ?>"
                               min="0"
                               max="10"
                               step="0.01"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Nota do Trabalho:</label>
                        <input type="number"
                               name="trabalho_<?= $i ?>"
                               min="0"
                               max="10"
                               step="0.01"
                               required>
                    </div>

                </div>

            <?php endfor; ?>

            <button type="submit" name="processar">
                Processar Resultados
            </button>

        <?php else: ?>

            <button type="submit" name="gerar">
                Gerar Campos
            </button>

        <?php endif; ?>

    </form>

    <?php if (isset($_POST['processar'])): ?>

        <div class="results">

            <h2>Resultado da Turma: <?= htmlspecialchars($turma) ?></h2>

            <h3>Tabela de Alunos</h3>

            <table class="results-table">

                <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Trabalho</th>
                    <th>Média</th>
                    <th>Raiz √(soma)</th>
                    <th>|Maior-Menor|</th>
                    <th>Situação</th>
                </tr>
                </thead>

                <tbody>

                <?php foreach ($alunos as $aluno): ?>

                    <tr>
                        <td><?= htmlspecialchars($aluno['nome']) ?></td>
                        <td><?= number_format($aluno['nota1'],2,',','.') ?></td>
                        <td><?= number_format($aluno['nota2'],2,',','.') ?></td>
                        <td><?= number_format($aluno['trabalho'],2,',','.') ?></td>
                        <td><?= number_format($aluno['media'],2,',','.') ?></td>
                        <td><?= number_format($aluno['raiz'],2,',','.') ?></td>
                        <td><?= number_format($aluno['difAbs'],2,',','.') ?></td>
                        <td><?= $aluno['situacao'] ?></td>
                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

            <h3>Relatório Estatístico da Turma</h3>

            <ul class="stats">
                <li><strong>Média Geral:</strong> <?= number_format($mediaGeral,2,',','.') ?></li>
                <li><strong>Maior Média:</strong> <?= number_format($maiorMedia,2,',','.') ?></li>
                <li><strong>Menor Média:</strong> <?= number_format($menorMedia,2,',','.') ?></li>
                <li><strong>Aprovados:</strong> <?= $totalAprovados ?></li>
                <li><strong>Recuperação:</strong> <?= $totalRecuperacao ?></li>
                <li><strong>Reprovados:</strong> <?= $totalReprovado ?></li>
                <li><strong>Percentual de Aprovação:</strong> <?= number_format($percentualAprovado,2,',','.') ?>%</li>
                <li><strong>Soma Total das Notas:</strong> <?= number_format($somaNotasTotal,2,',','.') ?></li>
            </ul>

            <div class="message">

                <?php

                /*
                    Mensagem de desempenho
                    Exibe uma avaliação geral baseada no percentual de aprovação obtido pela turma.
                */
                if ($percentualAprovado >= 70) {
                    echo "<p>Desempenho geral da turma: EXCELENTE.</p>";
                } elseif ($percentualAprovado >= 50) {
                    echo "<p>Desempenho geral da turma: SATISFATÓRIO.</p>";
                } else {
                    echo "<p>Desempenho geral da turma: PREOCUPANTE.</p>";
                }

                ?>

            </div>

        </div>

    <?php endif; ?>

</div>

</body>
</html>
