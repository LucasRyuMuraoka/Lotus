<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/carrinho.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="{{ Asset('/assets/images/icon.png') }}" />
    <script src="{{ asset('assets/js/carrinho.js') }}"></script> 

    <title>Lotus - Carrinho</title>
    @livewireStyles
</head>

<body>

    @livewire('customer-header')

    <main class="carrinho-main">

        <section class="carrinho-hero">
            <div class="carrinho-hero-content">
                <h1 class="animate__animated animate__fadeInDown">
                    Seu <span>Carrinho</span>
                </h1>
                <p class="animate__animated animate__fadeIn animate__delay-1s">
                    Revise seus itens e finalize seu pedido para saborear a autêntica
                    culinária japonesa.
                </p>
            </div>
        </section>

        <livewire:cart-content />

    </main>

    <div class="pre-footer-line"></div>

    @livewire('customer-footer')

    @livewireScripts
    @stack('scripts')
</body>

</html>