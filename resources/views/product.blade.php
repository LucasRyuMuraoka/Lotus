<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Carregue primeiro os estilos de normalização e globais -->
    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />

    <!-- Estilos principais -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/produto.css') }}" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        .cart-notification {
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            margin-top: 16px;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>

    <title>Produto - Lotus</title>
    @livewireStyles
</head>

<body>

    @livewire('customer-header')

    <main class="product-main">
        <div class="back-link">
            <a href="{{ route('cardapio') }}">
                <svg
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19 12H5M5 12L12 19M5 12L12 5"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Voltar para o Cardápio
            </a>
        </div>

        <div class="product-container">
            <div class="product-image animate__animated animate__fadeIn">
                <img
                    id="productImage"
                    src="{{ $product->url_image }}"
                    alt="{{ $product->name }}" />
                <div id="productBadge" class="product-badge" style="display: none">
                    Mais Pedido
                </div>
            </div>

            <div class="product-details animate__animated animate__fadeInRight">
                <h1 id="productName">{{ $product->name }}</h1>
                <div class="product-price" id="productPrice">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                <div class="product-description" id="productDescription">{{ $product->description }}</div>

                <div class="product-actions">
                    <div class="quantity-selector">
                        <button id="decreaseQuantity" class="quantity-btn">−</button>
                        <span id="quantityValue">1</span>
                        <button id="increaseQuantity" class="quantity-btn">+</button>
                    </div>

                    <livewire:add-to-cart-button :productId="$product->id" class="add-to-cart-btn" />
                    <div x-data="{ show: false, message: '' }"
                        x-show="show"
                        x-transition
                        x-init="
                             window.addEventListener('cart-added', e => {
                                 message = e.detail[0].message;
                                 show = true;
                                 setTimeout(() => show = false, 3000);
                             })
                         "
                        class="cart-notification"
                        style="display: none;">
                        <span x-text="message"></span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="pre-footer-line"></div>

    @livewire('customer-footer')

    <script src="{{ asset('assets/js/produto.js') }}"></script>
    @livewireScripts
</body>

</html>
