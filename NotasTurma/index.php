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
        // Processa os dados somente quando o formulário é enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $turma = trim($_POST['turma'] ?? '');
            $qtdAlunos = intval($_POST['qtd_alunos'] ?? 0);

            $alunos = [];
            $somaNotasTotal = 0;
            $totalAprovados = 0;
            $totalRecuperacao = 0;
            $totalReprovado = 0;
            $maiorMedia = 0;
            $menorMedia = PHP_INT_MAX;

            // Percorre todos os alunos informados no formulário
            for ($i = 0; $i < $qtdAlunos; $i++) {
                $nome = trim($_POST["nome_$i"] ?? '');
                $nota1 = floatval($_POST["nota1_$i"] ?? 0);
                $nota2 = floatval($_POST["nota2_$i"] ?? 0);
                $trabalho = floatval($_POST["trabalho_$i"] ?? 0);

                if ($nome === '') {
                    $nome = "Aluno " . ($i + 1);
                }

                // Realiza os cálculos individuais do aluno
                $media = ($nota1 + $nota2 + $trabalho) / 3;
                $raizQuadrada = sqrt($nota1 + $nota2 + $trabalho);
                $difAbsoluta = abs(max($nota1, $nota2, $trabalho) - min($nota1, $nota2, $trabalho));

                // Define a situação acadêmica pela média
                if ($media >= 7.0) {
                    $situacao = 'Aprovado';
                    $totalAprovados++;
                } elseif ($media >= 5.0) {
                    $situacao = 'Recuperação';
                    $totalRecuperacao++;
                } else {
                    $situacao = 'Reprovado';
                    $totalReprovado++;
                }

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

                // Atualiza os dados gerais da turma
                $somaNotasTotal += $nota1 + $nota2 + $trabalho;

                if ($media > $maiorMedia) {
                    $maiorMedia = $media;
                }

                if ($media < $menorMedia) {
                    $menorMedia = $media;
                }
            }

            // Calcula os resultados finais da turma
            $mediaGeral = $qtdAlunos > 0 ? ($somaNotasTotal / (3 * $qtdAlunos)) : 0;
            $percentualAprovado = $qtdAlunos > 0 ? ($totalAprovados / $qtdAlunos) * 100 : 0;
        }
        ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="turma">Nome da Turma:</label>
                <input type="text" id="turma" name="turma" value="<?= htmlspecialchars($turma ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="qtd_alunos">Quantidade de Alunos:</label>
                <input type="number" id="qtd_alunos" name="qtd_alunos" min="1" value="<?= htmlspecialchars($qtdAlunos ?? '') ?>" required>
            </div>

            <div id="alunos-container"></div>

            <button type="submit">Processar Resultados</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($alunos)): ?>
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
                        <td><?= number_format($aluno['nota1'], 2, ',', '.') ?></td>
                        <td><?= number_format($aluno['nota2'], 2, ',', '.') ?></td>
                        <td><?= number_format($aluno['trabalho'], 2, ',', '.') ?></td>
                        <td><?= number_format($aluno['media'], 2, ',', '.') ?></td>
                        <td><?= number_format($aluno['raiz'], 2, ',', '.') ?></td>
                        <td><?= number_format($aluno['difAbs'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($aluno['situacao']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3>Relatório Estatístico da Turma</h3>
            <ul class="stats">
                <li><strong>Média Geral da Turma:</strong> <?= number_format($mediaGeral, 2, ',', '.') ?></li>
                <li><strong>Maior Média:</strong> <?= number_format($maiorMedia, 2, ',', '.') ?></li>
                <li><strong>Menor Média:</strong> <?= number_format($menorMedia, 2, ',', '.') ?></li>
                <li><strong>Quantidade de Aprovados:</strong> <?= $totalAprovados ?></li>
                <li><strong>Quantidade de Recuperação:</strong> <?= $totalRecuperacao ?></li>
                <li><strong>Quantidade de Reprovados:</strong> <?= $totalReprovado ?></li>
                <li><strong>Percentual de Aprovação:</strong> <?= number_format($percentualAprovado, 2, ',', '.') ?>%</li>
                <li><strong>Soma Total de Todas as Notas:</strong> <?= number_format($somaNotasTotal, 2, ',', '.') ?></li>
            </ul>

            <div class="message">
                <?php
                // Mostra uma mensagem automática sobre o desempenho da turma
                if ($percentualAprovado >= 70) {
                    echo "<p>Desempenho geral da turma: EXCELENTE. A maioria dos alunos foi aprovada.</p>";
                } elseif ($percentualAprovado >= 50) {
                    echo "<p>Desempenho geral da turma: SATISFATÓRIO. Metade ou mais dos alunos foi aprovada.</p>";
                } else {
                    echo "<p>Desempenho geral da turma: PREOCUPANTE. Menos da metade dos alunos foi aprovada. Recomenda-se revisão de conteúdo.</p>";
                }
                ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
