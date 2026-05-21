document.addEventListener('DOMContentLoaded', function() {
    const qtdAlunosInput = document.getElementById('qtd_alunos');
    const alunosContainer = document.getElementById('alunos-container');

    // Cria os campos dos alunos conforme a quantidade digitada
    function gerarCamposAlunos() {
        alunosContainer.innerHTML = '';

        const qtdAlunos = parseInt(qtdAlunosInput.value) || 0;

        for (let i = 0; i < qtdAlunos; i++) {
            const alunoDiv = document.createElement('div');
            alunoDiv.className = 'student';

            alunoDiv.innerHTML = `
                <h3>Aluno ${i + 1}</h3>
                <div class="form-group">
                    <label for="nome_${i}">Nome:</label>
                    <input type="text" id="nome_${i}" name="nome_${i}" required>
                </div>
                <div class="form-group">
                    <label for="nota1_${i}">Nota da Prova 1:</label>
                    <input type="number" id="nota1_${i}" name="nota1_${i}" min="0" max="10" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="nota2_${i}">Nota da Prova 2:</label>
                    <input type="number" id="nota2_${i}" name="nota2_${i}" min="0" max="10" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="trabalho_${i}">Nota do Trabalho:</label>
                    <input type="number" id="trabalho_${i}" name="trabalho_${i}" min="0" max="10" step="0.01" required>
                </div>
            `;

            alunosContainer.appendChild(alunoDiv);
        }
    }

    // Atualiza os campos sempre que a quantidade mudar
    qtdAlunosInput.addEventListener('input', gerarCamposAlunos);
    gerarCamposAlunos();
});