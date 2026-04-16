// Lista fixa de produtos
const products = [
    { id: 1, name: "Mouse", price: 29.90 },
    { id: 2, name: "Teclado", price: 89.90 },
    { id: 3, name: "Headset", price: 149.90 },
    { id: 4, name: "Mousepad", price: 19.90 },
    { id: 5, name: "Webcam", price: 129.90 }
];

// Estrutura do carrinho (array de objetos)
let cart = [];

// Elementos do DOM
const productListEl = document.getElementById('productList');
const cartItemsEl = document.getElementById('cartItems');
const emptyCartMsgEl = document.getElementById('emptyCartMsg');
const totalValueEl = document.getElementById('totalValue');
const filterSelect = document.getElementById('filterSelect');

// Função para formatar moeda brasileira
function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

// Função para listar produtos (filtrados)
function listProducts() {
    const filter = filterSelect.value;
    let filteredProducts = [];

    switch (filter) {
        case 'under50':
            filteredProducts = products.filter(p => p.price <= 50);
            break;
        case 'over50':
            filteredProducts = products.filter(p => p.price > 50);
            break;
        default: // 'all'
            filteredProducts = [...products];
    }

    // Limpa a lista
    productListEl.innerHTML = '';

    // Cria cards para cada produto
    filteredProducts.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <h3>${product.name}</h3>
            <p>${formatCurrency(product.price)}</p>
            <button data-id="${product.id}">Adicionar ao Carrinho</button>
        `;
        productListEl.appendChild(card);
    });

    // Adiciona evento aos botões de adicionar
    document.querySelectorAll('.product-card button').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const productId = parseInt(e.target.dataset.id);
            addToCart(productId);
        });
    });
}

// Função para adicionar produto ao carrinho
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        // Se já existe, aumenta a quantidade
        existingItem.quantity += 1;
    } else {
        // Caso contrário, adiciona novo item com quantidade 1
        cart.push({ ...product, quantity: 1 });
    }

    // Atualiza interface e salva
    updateCart();
}

// Função para remover do carrinho
function removeFromCart(productId) {
    const itemIndex = cart.findIndex(item => item.id === productId);

    if (itemIndex !== -1) {
        if (cart[itemIndex].quantity > 1) {
            // Se quantidade > 1, diminui
            cart[itemIndex].quantity -= 1;
        } else {
            // Se quantidade = 1, remove completamente
            cart.splice(itemIndex, 1);
        }
    }

    // Atualiza interface e salva
    updateCart();
}

// Função para atualizar o total da compra
function updateTotal() {
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    totalValueEl.textContent = formatCurrency(total);
}

// Função para salvar carrinho no localStorage
function saveCart() {
    localStorage.setItem('shoppingCart', JSON.stringify(cart));
}

// Função para carregar carrinho do localStorage
function loadCart() {
    const saved = localStorage.getItem('shoppingCart');
    if (saved) {
        cart = JSON.parse(saved);
    }
}

// Função para renderizar o carrinho na tela
function renderCart() {
    // Limpa lista de itens
    cartItemsEl.innerHTML = '';

    if (cart.length === 0) {
        // Mostra mensagem de carrinho vazio
        emptyCartMsgEl.style.display = 'block';
        return;
    }

    emptyCartMsgEl.style.display = 'none';

    // Cria linhas para cada item do carrinho
    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
            <div class="cart-item-info">
                <div class="cart-item-name">${item.name}</div>
                <div class="cart-item-details">
                    Quantidade: <span class="cart-item-quantity">${item.quantity}</span> |
                    Preço unitário: <span class="cart-item-price">${formatCurrency(item.price)}</span>
                </div>
            </div>
            <div class="cart-item-actions">
                <button data-id="${item.id}">Remover</button>
            </div>
        `;
        cartItemsEl.appendChild(cartItem);
    });

    // Adiciona evento aos botões de remover
    document.querySelectorAll('.cart-item-actions button').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const productId = parseInt(e.target.dataset.id);
            removeFromCart(productId);
        });
    });
}

// Função principal de atualização do carrinho
function updateCart() {
    renderCart();
    updateTotal();
    saveCart();
}

// Evento de filtro
filterSelect.addEventListener('change', listProducts);

// Inicialização ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    loadCart();      // Recupera dados salvos
    listProducts();  // Lista produtos inicialmente
    updateCart();    // Renderiza carrinho e total
});