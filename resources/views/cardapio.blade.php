<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cardapio.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="{{ Asset('/assets/images/icon.png') }}" />

    <title>Lotus - Cardápio</title>
    @livewireStyles
</head>

<body>
    @livewire('customer-header')

    <main class="menu-c-main">
        <section class="menu-c-section-hero">
            <div class="menu-hero-content">
                <h1 class="animate__animated animate__fadeInDown">Nosso <span>Cardápio</span></h1>
                <p class="animate__animated animate__fadeIn animate__delay-1s">Descubra a autêntica experiência da
                    culinária
                    japonesa com nossos pratos cuidadosamente preparados.</p>
            </div>
        </section>

        <livewire:menu-section />

        <section class="menu-c-section-promo">
            <div class="menu-promo-content">
                <h2>Promoção da Semana</h2>
                <h3>Combinado Especial para Casal</h3>
                <p>16 peças de sushi + 2 temakis + 2 bebidas por apenas <span>R$ 99,90</span></p>
                <a href="#" class="menu-promo-btn">Aproveitar</a>
            </div>
        </section>
    </main>

    <div class="pre-footer-line"></div>
    @livewire('customer-footer')

    {{--
    <script src="{{ asset('assets/js/cardapio.js') }}"></script> --}}
    @livewireScripts
</body>

</html>