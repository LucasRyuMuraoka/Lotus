<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Lotus - Gerenciar Pratos</title>
    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/adm-pratos.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="{{ Asset('/assets/images/tori-icon.jpg') }}" />

</head>

<body>

    @livewire('admin-header')

    <main class="admpratos-admin-main">

        <section class="admpratos-admin-hero">
            <div class="admpratos-hero-content">
                <h1 class="animate__animated animate__fadeInDown">
                    Gerenciar <span>Pratos</span>
                </h1>
                <p class="animate__animated animate__fadeIn animate__delay-1s">
                    Adicione novos pratos ao cardápio ou edite os existentes.
                </p>
            </div>
        </section>

        <livewire:admin-product-manager />

    </main>

    <div class="pre-footer-line"></div>

    @livewire('admin-footer')

    {{--
    <script src="{{ asset('assets/js/pratos.js') }}"></script> --}}

</body>

</html>