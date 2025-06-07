document.addEventListener('DOMContentLoaded', function () {
  // Elementos do DOM
  const carrinhoVazio = document.getElementById('carrinho-vazio');
  const carrinhoComItens = document.getElementById('carrinho-com-itens');
  const carrinhoLista = document.getElementById('carrinho-lista');
  const subtotalElement = document.getElementById('subtotal');
  const totalElement = document.getElementById('total');
  const taxaEntrega = document.getElementById('taxa-entrega');
  const finalizarBtn = document.getElementById('finalizar-compra');
  const cupomInput = document.getElementById('cupom');
  const aplicarCupomBtn = document.getElementById('aplicar-cupom');
  const cupomMensagem = document.getElementById('cupom-mensagem');
  const cepInput = document.getElementById('cep');
  const ruaInput = document.getElementById('rua');
  const numeroInput = document.getElementById('numero');
  const bairroInput = document.getElementById('bairro');
  const cidadeInput = document.getElementById('cidade');

  // Cupons válidos
  const cupons = {
    'LOTUS10': { desconto: 0.1, mensagem: 'Desconto de 10% aplicado!' },
    'PROMO25': { desconto: 0.25, mensagem: 'Desconto de 25% aplicado!' },
    'FRETE': { frete: true, mensagem: 'Frete grátis aplicado!' }
  };

  // Valor da taxa de entrega
  const taxaEntregaValor = 12.90;
  let descontoAplicado = 0;
  let freteGratis = false;

  // Função para formatar valores em reais
  function formatarPreco(preco) {
    return 'R$ ' + preco.toFixed(2).replace('.', ',');
  }

  // Função para buscar o carrinho do localStorage
  function getCarrinho() {
    const carrinho = localStorage.getItem('lotusCarrinho');
    return carrinho ? JSON.parse(carrinho) : [];
  }

  // Função para salvar o carrinho no localStorage
  function salvarCarrinho(carrinho) {
    localStorage.setItem('lotusCarrinho', JSON.stringify(carrinho));
  }

  // Função para calcular o subtotal
  function calcularSubtotal(itens) {
    return itens.reduce((total, item) => total + (item.preco * item.quantidade), 0);
  }

  // Função para atualizar o resumo do pedido
  function atualizarResumo() {
    const carrinho = getCarrinho();
    const subtotal = calcularSubtotal(carrinho);

    // Aplica desconto se houver
    const subtotalComDesconto = subtotal * (1 - descontoAplicado);

    // Calcula o valor do frete
    const valorFrete = freteGratis ? 0 : taxaEntregaValor;

    // Calcula o total
    const total = subtotalComDesconto + valorFrete;

    // Atualiza os elementos na tela
    subtotalElement.textContent = formatarPreco(subtotalComDesconto);
    taxaEntrega.textContent = freteGratis ? 'Grátis' : formatarPreco(valorFrete);
    totalElement.textContent = formatarPreco(total);
  }

  // Função para renderizar os itens do carrinho
  function renderizarItens() {
    const carrinho = getCarrinho();

    // Limpa a lista de itens
    carrinhoLista.innerHTML = '';

    if (carrinho.length === 0) {
      carrinhoVazio.style.display = 'block';
      carrinhoComItens.style.display = 'none';
      return;
    }

    carrinhoVazio.style.display = 'none';
    carrinhoComItens.style.display = 'grid';

    // Adiciona cada item do carrinho à lista
    carrinho.forEach((item, index) => {
      const itemElement = document.createElement('div');
      itemElement.className = 'carrinho-item';

      itemElement.innerHTML = `
  <img src="${item.imagem}" alt="${item.nome}" class="item-img">
  <div class="item-info">
  <h3>${item.nome}</h3>
  <p>${item.descricao}</p>
  <span class="item-preco">${formatarPreco(item.preco)}</span>
  </div>
  <div class="item-controles">
  <div class="quantidade-controle">
  <div class="quantidade-btn menos" data-index="${index}">-</div>
  <input type="text" class="quantidade" value="${item.quantidade}" readonly>
  <div class="quantidade-btn mais" data-index="${index}">+</div>
  </div>
  <button class="remover-btn" data-index="${index}">Remover</button>
  </div>
  `;

      carrinhoLista.appendChild(itemElement);
    });

    // Adiciona eventos aos botões
    adicionarEventosItens();

    // Atualiza o resumo
    atualizarResumo();
  }

  // Função para adicionar eventos aos botões dos itens
  function adicionarEventosItens() {
    // Botões para diminuir quantidade
    document.querySelectorAll('.quantidade-btn.menos').forEach(btn => {
      btn.addEventListener('click', function () {
        const index = parseInt(this.dataset.index);
        alterarQuantidade(index, -1);
      });
    });

    // Botões para aumentar quantidade
    document.querySelectorAll('.quantidade-btn.mais').forEach(btn => {
      btn.addEventListener('click', function () {
        const index = parseInt(this.dataset.index);
        alterarQuantidade(index, 1);
      });
    });

    // Botões para remover itens
    document.querySelectorAll('.remover-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        const index = parseInt(this.dataset.index);
        removerItem(index);
      });
    });
  }

  // Função para alterar a quantidade de um item
  function alterarQuantidade(index, delta) {
    const carrinho = getCarrinho();

    // Verifica se o índice é válido
    if (index < 0 || index >= carrinho.length) return;

    // Altera a quantidade
    carrinho[index].quantidade += delta;

    // Verifica se a quantidade é positiva
    if (carrinho[index].quantidade <= 0) {
      removerItem(index);
      return;
    }

    // Salva o carrinho atualizado
    salvarCarrinho(carrinho);

    // Renderiza os itens novamente
    renderizarItens();
  }

  // Função para remover um item
  function removerItem(index) {
    const carrinho = getCarrinho();

    // Verifica se o índice é válido
    if (index < 0 || index >= carrinho.length) return;

    // Remove o item
    carrinho.splice(index, 1);

    // Salva o carrinho atualizado
    salvarCarrinho(carrinho);

    // Renderiza os itens novamente
    renderizarItens();
  }

  // Função para aplicar cupom de desconto
  function aplicarCupom() {
    const codigo = cupomInput.value.trim().toUpperCase();

    // Verifica se o cupom existe
    if (!cupons[codigo]) {
      cupomMensagem.textContent = 'Cupom inválido!';
      cupomMensagem.className = '';
      return;
    }

    // Aplica o cupom
    const cupom = cupons[codigo];

    if (cupom.desconto) {
      descontoAplicado = cupom.desconto;
    }

    if (cupom.frete) {
      freteGratis = true;
    }

    // Exibe mensagem de sucesso
    cupomMensagem.textContent = cupom.mensagem;
    cupomMensagem.className = 'success';

    // Atualiza o resumo
    atualizarResumo();
  }

  // Função para buscar dados de endereço pelo CEP
  function buscarCep() {
    const cep = cepInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    // Verifica se o CEP tem 8 dígitos
    if (cep.length !== 8) {
      alert('CEP inválido. Digite um CEP com 8 dígitos.');
      return;
    }

    // Faz a requisição à API ViaCEP
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(response => response.json())
      .then(data => {
        if (data.erro) {
          alert('CEP não encontrado.');
          limparEndereco();
        } else {
          // Preenche os campos do formulário com os dados retornados
          ruaInput.value = data.logradouro;
          bairroInput.value = data.bairro;
          cidadeInput.value = data.localidade;
          numeroInput.focus(); // Coloca o foco no campo número
        }
      })
      .catch(error => {
        console.error('Erro ao buscar CEP:', error);
        alert('Erro ao buscar CEP. Tente novamente.');
        limparEndereco();
      });
  }

  // Função para limpar os campos de endereço
  function limparEndereco() {
    ruaInput.value = '';
    bairroInput.value = '';
    cidadeInput.value = '';
  }

  // Função para finalizar o pedido
  function finalizarPedido() {
    const carrinho = getCarrinho();

    // Verifica se tem itens no carrinho
    if (carrinho.length === 0) {
      alert('Adicione itens ao carrinho para finalizar o pedido.');
      return;
    }

    // Verifica se os campos de endereço estão preenchidos
    const cep = cepInput.value;
    const rua = ruaInput.value;
    const numero = numeroInput.value;
    const bairro = bairroInput.value;
    const cidade = cidadeInput.value;

    if (!cep || !rua || !numero || !bairro || !cidade) {
      alert('Preencha todos os campos de endereço para continuar.');
      return;
    }

    alert('Pedido realizado com sucesso! Em breve você receberá mais informações no seu e-mail.');

    // Limpa o carrinho
    localStorage.removeItem('lotusCarrinho');

    window.location.href = 'home.html';
  }

  function adicionarDadosExemplo() {
    // Verifica se já existem itens no carrinho
    if (getCarrinho().length > 0) return;

    const exemploCarrinho = [
      {
        id: 1,
        nome: 'Combo Sushi 1',
        descricao: 'Combo sushi 1.',
        preco: 25.90,
        imagem: 'assets/images/sushi3.png',
        quantidade: 2
      },
      {
        id: 2,
        nome: 'Combo Sushi 2',
        descricao: 'Combo sushi 2.',
        preco: 18.50,
        imagem: 'assets/images/sushi2.jpg',
        quantidade: 1
      },
      {
        id: 3,
        nome: 'Combo Sushi 3',
        descricao: 'Combo sushi 3.',
        preco: 12.00,
        imagem: 'assets/images/sushi3.jpeg',
        quantidade: 3
      }
    ];

    salvarCarrinho(exemploCarrinho);
  }

  aplicarCupomBtn.addEventListener('click', aplicarCupom);
  cepInput.addEventListener('blur', buscarCep);
  finalizarBtn.addEventListener('click', finalizarPedido);

  // Carrega os dados do carrinho e renderiza a página
  adicionarDadosExemplo(); // Adiciona dados de exemplo se o carrinho estiver vazio
  renderizarItens();
});
