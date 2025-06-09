document.addEventListener("DOMContentLoaded", function () {
  // Elementos do DOM
  const productName = document.getElementById("productName");
  const productPrice = document.getElementById("productPrice");
  const productDescription = document.getElementById("productDescription");
  const productImage = document.getElementById("productImage");
  const productBadge = document.getElementById("productBadge");
  const quantityValue = document.getElementById("quantityValue");
  const decreaseBtn = document.getElementById("decreaseQuantity");
  const increaseBtn = document.getElementById("increaseQuantity");
  const addToCartButton = document.getElementById("addToCartButton");

  // Pegar o ID do produto da URL
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get("id");

  // Encontrar o produto pelo ID
  const product = allProducts.find((p) => p.id === productId) || allProducts[0];

  // Atualizar os elementos da página com as informações do produto
  function updateProductDetails() {
    document.title = `${product.name} - Lotus`;
    productName.textContent = product.name;
    productPrice.textContent = product.price;
    productDescription.textContent = product.description;
    productImage.src = product.image;
    productImage.alt = product.name;

    // Mostrar ou esconder badge
    if (product.badge) {
      productBadge.textContent = product.badge;
      productBadge.style.display = "block";
    } else {
      productBadge.style.display = "none";
    }
  }

  // Controle de quantidade
  let quantity = 1;

  function updateQuantityDisplay() {
    quantityValue.textContent = quantity;
  }

  decreaseBtn.addEventListener("click", function () {
    if (quantity > 1) {
      quantity--;
      updateQuantityDisplay();
    }
  });

  increaseBtn.addEventListener("click", function () {
    quantity++;
    updateQuantityDisplay();
  });

  // Adicionar ao carrinho
  addToCartButton.addEventListener("click", function () {
    alert(
      `Item adicionado ao carrinho!\n${product.name} - ${product.price} - Quantidade: ${quantity}`
    );

    // Animação de feedback
    const originalText = addToCartButton.textContent;
    const originalColor = addToCartButton.style.backgroundColor;

    addToCartButton.textContent = "Adicionado ✓";
    addToCartButton.style.backgroundColor = "#28a745";

    setTimeout(() => {
      addToCartButton.textContent = originalText;
      addToCartButton.style.backgroundColor = originalColor;
    }, 1500);
  });

  // Inicializar a página
  function initProductPage() {
    updateProductDetails();
    updateQuantityDisplay();
  }

  initProductPage();
});
