<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lotus - Cadastro</title>
    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cadastro.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="{{ Asset('/assets/images/icon.png') }}" />
    @livewireStyles
</head>

<body>
    <div class="register-page-wrapper">

        <div class="signup-floating-element"></div>
        <div class="signup-floating-element"></div>

        <div class="signup-container animate__animated animate__fadeInUp">
            <div class="signup-logo-section animate__animated animate__fadeInDown animate__delay-1s">
                <div class="signup-logo"><a href="{{ route('home') }}">LOTUS</a></div>
                <div class="signup-tagline">Experiência gastronômica Oriental única</div>
            </div>

            <h2 class="signup-form-title animate__animated animate__fadeIn animate__delay-2s">Criar Conta</h2>

            <livewire:register-form />

            <div class="signup-login-link animate__animated animate__fadeIn animate__delay-6s">
                Já tem uma conta? <a href="{{ route('entrar') }}">Fazer login</a>
            </div>
        </div>

        <script src="{{ asset('assets/js/cadastro.js') }}"></script>
        @livewireScripts
    </div>
</body>

</html>