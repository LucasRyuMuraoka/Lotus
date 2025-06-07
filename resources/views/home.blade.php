<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('asset/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/modules/swiper.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <title>Lotus</title>
    @livewireStyles
</head>

<body>

    @livewire('customer-header')

    @livewire('customer-home-main')

    <div class="pre-footer-line"></div>

    @livewire('customer-footer')


    <!-- Primeiro carregue a biblioteca Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Depois seu script de inicialização -->
    <script src="{{ asset('assets/js/home.js') }}"></script>
    @livewireScripts
</body>

</html>
