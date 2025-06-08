<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotus - Cadastro</title>
    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cadastro.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('/assets/images/torii gate guia logo.jpg') }}">
    @livewireStyles
</head>

<body>
    <div class="floating-element"></div>
    <div class="floating-element"></div>

    <div class="signup-container animate__animated animate__fadeInUp">
        <div class="logo-section animate__animated animate__fadeInDown animate__delay-1s">
            <div class="logo">LOTUS</div>
            <div class="tagline">Experiência gastronômica Oriental única</div>
        </div>

        <h2 class="form-title animate__animated animate__fadeIn animate__delay-2s">Criar Conta</h2>

        <livewire:register-form />

        <div class="login-link animate__animated animate__fadeIn animate__delay-6s">
            Já tem uma conta? <a href="{{ route('entrar') }}">Fazer login</a>
        </div>
    </div>

    <script src="{{ asset('assets/js/cadastro.js') }}"></script>
    @livewireScripts
</body>

</html>
