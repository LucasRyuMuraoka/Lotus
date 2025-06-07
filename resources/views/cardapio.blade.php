<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cardapio.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

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

    <title>Cardápio - Lotus</title>
    @livewireStyles
</head>

<body>
    @livewire('customer-header')

    <main class="c-main">
        <section class="c-section-hero">
            <div class="hero-content">
                <h1 class="animate__animated animate__fadeInDown">Nosso <span>Cardápio</span></h1>
                <p class="animate__animated animate__fadeIn animate__delay-1s">Descubra a autêntica experiência da culinária
                    japonesa com nossos pratos cuidadosamente preparados.</p>
            </div>
        </section>

        <livewire:menu-section />

        <section class="c-section-promo">
            <div class="promo-content">
                <h2>Promoção da Semana</h2>
                <h3>Combinado Especial para Casal</h3>
                <p>16 peças de sushi + 2 temakis + 2 bebidas por apenas <span>R$ 99,90</span></p>
                <a href="#" class="promo-btn">Aproveitar</a>
            </div>
        </section>
    </main>

    <div class="pre-footer-line"></div>
    @livewire('customer-footer')

    {{-- <script src="{{ asset('assets/js/cardapio.js') }}"></script> --}}
    @livewireScripts
</body>

</html>
