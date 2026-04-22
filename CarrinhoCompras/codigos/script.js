// Array com os produtos
const produtos = [
    // Futebol/Futsal
    {
        id: 1,
        nome: "Bola de futsal",
        preco: 79.90,
        esporte: "Futebol/Futsal",
        imagem: "../imagens/bola_futsal.webp"
    },
    {
        id: 2,
        nome: "Chuteira society",
        preco: 199.90,
        esporte: "Futebol/Futsal",
        imagem: "../imagens/chuteira_society.webp"
    },
    {
        id: 3,
        nome: "Caneleira",
        preco: 49.90,
        esporte: "Futebol/Futsal",
        imagem: "../imagens/caneleira.webp"
    },
    {
        id: 4,
        nome: "Meião esportivo",
        preco: 29.90,
        esporte: "Futebol/Futsal",
        imagem: "../imagens/meiao.webp"
    },
    {
        id: 5,
        nome: "Camisa de treino",
        preco: 89.90,
        esporte: "Futebol/Futsal",
        imagem: "../imagens/camisa_treino.webp"
    },

    // Vôlei
    {
        id: 6,
        nome: "Bola de vôlei",
        preco: 89.90,
        esporte: "Vôlei",
        imagem: "../imagens/bola_volei.webp"
    },
    {
        id: 7,
        nome: "Joelheira",
        preco: 39.90,
        esporte: "Vôlei",
        imagem: "../imagens/joelheira.webp"
    },
    {
        id: 8,
        nome: "Manguito",
        preco: 34.90,
        esporte: "Vôlei",
        imagem: "../imagens/manguito.webp"
    },
    {
        id: 9,
        nome: "Camisa dry fit",
        preco: 79.90,
        esporte: "Vôlei",
        imagem: "../imagens/camisa_dryfit.webp"
    },
    {
        id: 10,
        nome: "Tênis de quadra",
        preco: 149.90,
        esporte: "Vôlei",
        imagem: "../imagens/tenis_volei.webp"
    },

    // Basquete
    {
        id: 11,
        nome: "Bola de basquete",
        preco: 99.90,
        esporte: "Basquete",
        imagem: "../imagens/bola_basquete.webp"
    },
    {
        id: 12,
        nome: "Regata esportiva",
        preco: 49.90,
        esporte: "Basquete",
        imagem: "../imagens/regata_basquete.webp"
    },
    {
        id: 13,
        nome: "Bermuda esportiva",
        preco: 59.90,
        esporte: "Basquete",
        imagem: "../imagens/bermuda_basquete.webp"
    },
    {
        id: 14,
        nome: "Munhequeira",
        preco: 24.90,
        esporte: "Basquete",
        imagem: "../imagens/munhequeira.webp"
    },
    {
        id: 15,
        nome: "Tênis de basquete",
        preco: 229.90,
        esporte: "Basquete",
        imagem: "../imagens/tenis_basquete.webp"
    },

    // Tênis de mesa
    {
        id: 16,
        nome: "Raquete",
        preco: 129.90,
        esporte: "Tênis de mesa",
        imagem: "../imagens/raquete_tenis_mesa.webp"
    },
    {
        id: 17,
        nome: "Kit de bolinhas",
        preco: 19.90,
        esporte: "Tênis de mesa",
        imagem: "../imagens/bolinhas_tenis_mesa.webp"
    },
    {
        id: 18,
        nome: "Borracha para raquete",
        preco: 29.90,
        esporte: "Tênis de mesa",
        imagem: "../imagens/borracha_tenis_mesa.webp"
    },
    {
        id: 19,
        nome: "Capa para raquete",
        preco: 39.90,
        esporte: "Tênis de mesa",
        imagem: "../imagens/raqueteira_tenis_mesa.webp"
    },
    {
        id: 20,
        nome: "Rede para tênis de mesa",
        preco: 89.90,
        esporte: "Tênis de mesa",
        imagem: "../imagens/rede_tenis_mesa.webp"
    },

    // Tênis
    {
        id: 21,
        nome: "Raquete de tênis",
        preco: 279.90,
        esporte: "Tênis",
        imagem: "../imagens/raquete_tenis.webp"
    },
    {
        id: 22,
        nome: "Bola de tênis",
        preco: 39.90,
        esporte: "Tênis",
        imagem: "../imagens/bolinhas_tenis.webp"
    },
    {
        id: 23,
        nome: "Overgrip",
        preco: 24.90,
        esporte: "Tênis",
        imagem: "../imagens/overgrip_tenis.webp"
    },
    {
        id: 24,
        nome: "Munhequeira",
        preco: 24.90,
        esporte: "Tênis",
        imagem: "../imagens/munhequeira_tenis.webp"
    },
    {
        id: 25,
        nome: "Mochila esportiva",
        preco: 149.90,
        esporte: "Tênis",
        imagem: "../imagens/mochila_tenis.webp"
    }
];

// Array do carrinho
let carrinho = [];

// Função para listar produtos
function listarProdutos() {
    const listaProdutos = document.getElementById('listaProdutos');
    listaProdutos.innerHTML = '';

    const produtosFiltrados = filtrarProdutos();

    produtosFiltrados.forEach(produto => {
        const produtoCard = document.createElement('div');
        produtoCard.className = 'produto-card';
        produtoCard.innerHTML = `
            <img src="${produto.imagem}" alt="${produto.nome}">
            <h3>${produto.nome}</h3>
            <span class="esporte">${produto.esporte}</span>
            <p class="preco">R$ ${produto.preco.toFixed(2)}</p>
            <button onclick="adicionarAoCarrinho(${produto.id})">Adicionar ao carrinho</button>
        `;
        listaProdutos.appendChild(produtoCard);
    });
}

// Função para filtrar produtos
function filtrarProdutos() {
    const filtroPreco = document.getElementById('filtroPreco').value;
    const filtroEsporte = document.getElementById('filtroEsporte').value;

    const esporteMap = {
        futebol: 'Futebol/Futsal',
        volei: 'Vôlei',
        basquete: 'Basquete',
        tenisMesas: 'Tênis de mesa',
        tenis: 'Tênis'
    };

    return produtos.filter(produto => {
        // Filtro por esporte
        let esporteMatch = true;
        if (filtroEsporte !== 'todos') {
            const targetEsporte = esporteMap[filtroEsporte];
            esporteMatch = (produto.esporte === targetEsporte);
        }

        // Filtro por preço (usando switch como solicitado)
        let precoMatch = true;
        switch (filtroPreco) {
            case 'todos':
                precoMatch = true;
                break;
            case 'ate50':
                precoMatch = (produto.preco <= 50);
                break;
            case 'acima50':
                precoMatch = (produto.preco > 50);
                break;
            default:
                precoMatch = true;
        }

        return esporteMatch && precoMatch;
    });
}

// Função para adicionar ao carrinho
function adicionarAoCarrinho(id) {
    const produto = produtos.find(p => p.id === id);
    const itemExistente = carrinho.find(item => item.id === id);

    if (itemExistente) {
        // Se já existe, aumenta a quantidade
        itemExistente.quantidade++;
    } else {
        // Se não existe, adiciona com quantidade 1
        carrinho.push({ ...produto, quantidade: 1 });
    }

    salvarCarrinho();
    renderizarCarrinho();
}

// Função para aumentar quantidade
function aumentarQuantidade(id) {
    const item = carrinho.find(item => item.id === id);
    if (item) {
        item.quantidade++;
        salvarCarrinho();
        renderizarCarrinho();
    }
}

// Função para diminuir quantidade
function diminuirQuantidade(id) {
    const item = carrinho.find(item => item.id === id);
    if (item) {
        if (item.quantidade > 1) {
            item.quantidade--;
        } else {
            // Se quantidade for 1, remove o item
            removerItem(id);
            return;
        }
        salvarCarrinho();
        renderizarCarrinho();
    }
}

// Função para remover item específico
function removerItem(id) {
    carrinho = carrinho.filter(item => item.id !== id);
    salvarCarrinho();
    renderizarCarrinho();
}

// Função para limpar carrinho
function limparCarrinho() {
    carrinho = [];
    salvarCarrinho();
    renderizarCarrinho();
}

// Função para atualizar total
function atualizarTotal() {
    const total = carrinho.reduce((sum, item) => sum + (item.preco * item.quantidade), 0);
    document.getElementById('valorTotal').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
}

// Função para salvar carrinho no localStorage
function salvarCarrinho() {
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
}

// Função para carregar carrinho do localStorage
function carregarCarrinho() {
    const carrinhoSalvo = localStorage.getItem('carrinho');
    if (carrinhoSalvo) {
        carrinho = JSON.parse(carrinhoSalvo);
    }
}

// Função para renderizar carrinho
function renderizarCarrinho() {
    const carrinhoVazio = document.getElementById('carrinhoVazio');
    const itensCarrinho = document.getElementById('itensCarrinho');

    if (carrinho.length === 0) {
        carrinhoVazio.style.display = 'block';
        itensCarrinho.innerHTML = '';
    } else {
        carrinhoVazio.style.display = 'none';
        itensCarrinho.innerHTML = '';

        carrinho.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'item-carrinho';
            itemElement.innerHTML = `
                <div class="item-info">
                    <h4>${item.nome}</h4>
                    <div class="item-quantidade">
                        <button onclick="diminuirQuantidade(${item.id})">-</button>
                        <span>${item.quantidade}</span>
                        <button onclick="aumentarQuantidade(${item.id})">+</button>
                    </div>
                </div>
                <div class="item-preco">
                    <p>R$ ${item.preco.toFixed(2)}</p>
                    <p class="subtotal">R$ ${(item.preco * item.quantidade).toFixed(2)}</p>
                    <button class="btn-excluir" onclick="removerItem(${item.id})">Excluir</button>
                </div>
            `;
            itensCarrinho.appendChild(itemElement);
        });
    }

    atualizarTotal();
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    carregarCarrinho();
    listarProdutos();
    renderizarCarrinho();

    document.getElementById('filtroPreco').addEventListener('change', () => {
        listarProdutos();
    });

    document.getElementById('filtroEsporte').addEventListener('change', () => {
        listarProdutos();
    });

    document.getElementById('limparCarrinho').addEventListener('click', () => {
        limparCarrinho();
    });
});