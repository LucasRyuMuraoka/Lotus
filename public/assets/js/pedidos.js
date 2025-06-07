document.addEventListener('DOMContentLoaded', function() {
  // Funcionalidade das abas
  const tabButtons = document.querySelectorAll('.account-tab-btn');
  const tabContents = document.querySelectorAll('.account-tab-content');
  
  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      // Remover classe 'active' de todos os botões e conteúdos
      tabButtons.forEach(btn => btn.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));
      
      // Adicionar classe 'active' ao botão clicado
      button.classList.add('active');
      
      // Mostrar o conteúdo correspondente
      const tabId = button.getAttribute('data-tab');
      document.getElementById(tabId).classList.add('active');
    });
  });
  
  // Filtro de pedidos por status
  const statusFilter = document.getElementById('filter-status');
  const orderCards = document.querySelectorAll('.order-card');
  
  statusFilter.addEventListener('change', () => {
    const selectedStatus = statusFilter.value;
    
    orderCards.forEach(card => {
      const cardStatus = card.getAttribute('data-status');
      
      if (selectedStatus === 'todos' || selectedStatus === cardStatus) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  });
  
  // Botões de ação dos pedidos
  const trackButtons = document.querySelectorAll('.order-track');
  trackButtons.forEach(button => {
    button.addEventListener('click', function() {
      const orderNumber = this.closest('.order-card').querySelector('.order-number h3').textContent.split('#')[1];
      alert(`Rastreando pedido #${orderNumber}. O entregador está a 10 minutos do seu endereço.`);
    });
  });
  
  const reorderButtons = document.querySelectorAll('.order-reorder');
  reorderButtons.forEach(button => {
    button.addEventListener('click', function() {
      const orderNumber = this.closest('.order-card').querySelector('.order-number h3').textContent.split('#')[1];
      alert(`Pedido #${orderNumber} adicionado ao carrinho. Continue para finalizar a compra.`);
    });
  });
  
  const cancelButtons = document.querySelectorAll('.order-cancel');
  cancelButtons.forEach(button => {
    button.addEventListener('click', function() {
      const orderCard = this.closest('.order-card');
      const orderNumber = orderCard.querySelector('.order-number h3').textContent.split('#')[1];
      
      const confirmar = confirm(`Tem certeza que deseja cancelar o pedido #${orderNumber}?`);
      
      if (confirmar) {
        // Atualizar visualmente o status do pedido
        orderCard.setAttribute('data-status', 'Cancelado');
        
        const statusElement = orderCard.querySelector('.order-status');
        statusElement.className = 'order-status status-canceled';
        statusElement.querySelector('span').textContent = 'Cancelado';
        
        // Remover informações de preparação e adicionar mensagem de cancelamento
        const prepInfo = orderCard.querySelector('.order-prep-info');
        if (prepInfo) {
          prepInfo.remove();
          
          const cancelInfo = document.createElement('div');
          cancelInfo.className = 'order-cancel-info';
          cancelInfo.innerHTML = `
            <p>Motivo:</p>
            <span>Cancelado pelo cliente</span>
          `;
          
          orderCard.querySelector('.order-details').insertAdjacentElement('afterend', cancelInfo);
        }
        
        // Substituir o botão cancelar por "pedir novamente"
        this.parentNode.removeChild(this);
        
        const reorderBtn = document.createElement('button');
        reorderBtn.className = 'order-reorder';
        reorderBtn.textContent = 'Pedir novamente';
        reorderBtn.addEventListener('click', function() {
          alert(`Pedido #${orderNumber} adicionado ao carrinho. Continue para finalizar a compra.`);
        });
        
        orderCard.querySelector('.order-actions').appendChild(reorderBtn);
        
        alert(`Pedido #${orderNumber} cancelado com sucesso.`);
      }
    });
  });
  
  // Função para animar elementos quando entrarem na visualização
  const animateElements = document.querySelectorAll('.animate__animated');
  
  function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }
  
  function checkAnimations() {
    animateElements.forEach(element => {
      if (isElementInViewport(element) && !element.classList.contains('animate__showed')) {
        element.classList.add('animate__showed');
      }
    });
  }
  
  // Verificar animações no carregamento e durante a rolagem
  window.addEventListener('scroll', checkAnimations);
  window.addEventListener('resize', checkAnimations);
  checkAnimations();
});