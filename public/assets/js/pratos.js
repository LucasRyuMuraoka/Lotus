const pratoForm = document.getElementById('prato-form');
const pratosLista = document.getElementById('pratos-lista');

// Array para armazenar os pratos (substitua por uma chamada à API se necessário)
let pratos = [
    { id: 1, nome: 'Sushi Clássico', descricao: 'Variedade de sushis tradicionais.', categoria: 'Sushi', preco: 25.99, imagem: 'sushi.jpg' },
    { id: 2, nome: 'Sashimi Premium', descricao: 'Fatias frescas de peixe cru.', categoria: 'Sashimi', preco: 32.50, imagem: 'sashimi.jpg' }
    // ... mais pratos
];

// Função para renderizar os pratos na lista
function renderizarPratos() {
    pratosLista.innerHTML = ''; // Limpa a lista antes de renderizar novamente
    pratos.forEach(prato => {
        const li = document.createElement('li');
        li.innerHTML = `
            <span>${prato.nome}</span>
            <div class="acoes">
                <a href="#" class="editar" data-id="${prato.id}">Editar</a> |
                <a href="#" class="excluir" data-id="${prato.id}">Excluir</a>
            </div>
        `;
        pratosLista.appendChild(li);
    });
}

function adicionarPrato(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const nome = document.getElementById('nome').value;
    const descricao = document.getElementById('descricao').value;
    const categoria = document.getElementById('categoria').value;
    const preco = parseFloat(document.getElementById('preco').value);
    const imagem = document.getElementById('imagem').value;

    const novoPrato = {
        id: Date.now(), // Simula um ID único (use um gerador de ID adequado em produção)
        nome,
        descricao,
        categoria,
        preco,
        imagem
    };

    // Adiciona o novo prato ao array
    pratos.push(novoPrato);

    // Limpa o formulário
    pratoForm.reset();

    // Renderiza a lista de pratos atualizada
    renderizarPratos();
}

function editarPrato(id) {
    const prato = pratos.find(prato => prato.id === id);
    if (prato) {
        document.getElementById('nome').value = prato.nome;
        document.getElementById('descricao').value = prato.descricao;
        document.getElementById('categoria').value = prato.categoria;
        document.getElementById('preco').value = prato.preco;
        document.getElementById('imagem').value = prato.imagem;
        // Você pode precisar de um estado para controlar se está editando ou adicionando
        // e mudar o texto do botão de "Adicionar Prato" para "Salvar Alterações"
    }
}

function excluirPrato(id) {
    pratos = pratos.filter(prato => prato.id !== id);
    renderizarPratos();
}

pratoForm.addEventListener('submit', adicionarPrato);

pratosLista.addEventListener('click', function (event) {
    const target = event.target;
    if (target.classList.contains('editar')) {
        const id = parseInt(target.dataset.id);
        editarPrato(id);
    }
    if (target.classList.contains('excluir')) {
        const id = parseInt(target.dataset.id);
        excluirPrato(id);
    }
});

// Renderiza os pratos iniciais na lista
renderizarPratos();
