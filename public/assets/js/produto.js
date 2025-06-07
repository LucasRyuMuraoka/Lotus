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

  // Banco de dados de produtos (normalmente isso viria de um backend)
  const allProducts = [
    {
      id: "1",
      name: "Combinado Premium",
      price: "R$ 95,90",
      description:
        "Seleção especial dos nossos melhores sushis e sashimis. Uma experiência gastronômica completa com peças variadas incluindo salmão, atum e peixe branco.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: "Mais Pedido",
      category: "recomendacoes",
    },
    {
      id: "2",
      name: "Hot Roll Especial",
      price: "R$ 35,90",
      description:
        "Roll empanado com recheio de salmão, cream cheese e cebolinha. Crocante por fora e macio por dentro, acompanha molho tarê.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: "Favorito",
      category: "recomendacoes",
    },
    {
      id: "3",
      name: "Uramaki de Salmão",
      price: "R$ 32,90",
      description:
        "Arroz, alga nori, salmão fresco, cream cheese e cebolinha. Preparado com os melhores ingredientes para um sabor autêntico.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: null,
      category: "sushi",
    },
    {
      id: "4",
      name: "Temaki Especial",
      price: "R$ 25,90",
      description:
        "Cone de alga recheado com arroz, salmão, cream cheese e cebolinha. Perfeito para quem busca uma opção prática e saborosa.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: null,
      category: "sushi",
    },
    {
      id: "5",
      name: "Sashimi de Salmão",
      price: "R$ 38,90",
      description:
        "Fatias finas de salmão fresco, servido com molho shoyu e wasabi. Um clássico da culinária japonesa com o melhor peixe importado.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: null,
      category: "sashimi",
    },
    {
      id: "6",
      name: "Sashimi de Atum",
      price: "R$ 42,90",
      description:
        "Fatias frescas de atum, servido com molho especial da casa. Cor vibrante e sabor único para os apreciadores de peixe cru.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: null,
      category: "sashimi",
    },
    {
      id: "7",
      name: "Combinado Lotus",
      price: "R$ 85,90",
      description:
        "8 peças de sushi, 8 peças de sashimi e 4 peças de hossomaki. Um combinado exclusivo do nosso restaurante com variedade de sabores.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: null,
      category: "combinados",
    },
    {
      id: "8",
      name: "Festival de Sushi",
      price: "R$ 149,90",
      description:
        "40 peças variadas incluindo niguiri, uramaki, hossomaki e sashimi. Ideal para compartilhar com amigos ou família.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: null,
      category: "combinados",
    },
    {
      id: "9",
      name: "Sake Tradicional",
      price: "R$ 45,90",
      description:
        "Sake japonês premium, servido quente ou frio (300ml). Bebida alcoólica de arroz que complementa perfeitamente as refeições japonesas.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: null,
      category: "bebidas",
    },
    {
      id: "10",
      name: "Matcha Latte",
      price: "R$ 22,90",
      description:
        "Bebida de chá verde matcha com leite quente ou gelado. Um clássico da culinária japonesa com propriedades antioxidantes.",
      image:
        "https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=",
      badge: null,
      category: "bebidas",
    },
  ];

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
