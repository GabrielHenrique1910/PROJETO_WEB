function confirmarExclusao(id, nome, tipo) {
    // Monta a mensagem de alerta
    var mensagem = "Você tem certeza que deseja excluir " + tipo + " '" + nome + "'?";
    
    // Se for país ou continente, avisa sobre a exclusão em cascata
    if (tipo === 'país' || tipo === 'continente') {
        mensagem += "\n\nATENÇÃO: Se houver cidades ou países vinculados, eles também serão excluídos do banco de dados!";
    }

    // Pergunta ao usuário. Se ele clicar em OK, redireciona para a página de exclusão
    if (confirm(mensagem)) {
        window.location.href = "excluir.php?id=" + id;
    }
}