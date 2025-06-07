<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lotus蓮 - Diretório de Usuarios</title>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/adm-pratos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @livewireStyles
</head>

<body>

    @livewire('admin-header')

    <main class="main-content">
        <div class="logo-container">
            <img src="assets/images/logo adm.png" alt="Lotus Logo" title="Lotus Logo" class="centered-logo animate__animated animate__fadeIn" />
        </div>
    </main>


    <div class="pre-footer-line"></div>

    @livewire('admin-footer')

    @livewireScripts
</body>

</html>
