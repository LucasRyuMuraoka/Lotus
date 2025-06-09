document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('.menu-filter-btn');
  const menuItems = document.querySelectorAll('.menu-item');

  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      filterButtons.forEach(btn => btn.classList.remove('active'));

      button.classList.add('active');

      const filterValue = button.getAttribute('data-filter');

      // Filtrar itens do menu
      menuItems.forEach(item => {
        if (filterValue === 'todos') {
          item.classList.remove('hide');
        } else if (!item.classList.contains(filterValue)) {
          item.classList.add('hide');
        } else {
          item.classList.remove('hide');
        }
      });
    });
  });

  const addButtons = document.querySelectorAll('.menu-add');
  addButtons.forEach(button => {
    button.addEventListener('click', function() {
      const menuItem = this.closest('.menu-info');
      const itemName = menuItem.querySelector('h3').textContent;
      const itemPrice = menuItem.querySelector('.menu-price').textContent;

      alert(`Item adicionado ao carrinho!\n${itemName} - ${itemPrice}`);

      // Animação de feedback
      button.textContent = "Adicionado ✓";
      button.style.backgroundColor = "#28a745";

      setTimeout(() => {
        button.textContent = "Adicionar";
        button.style.backgroundColor = "";
      }, 1500);
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
