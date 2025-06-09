<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lotus - Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="{{ Asset('/assets/images/icon.png') }}" />
</head>

<body>
    <div class="login-page-wrapper">

        <div class="floating-particle"></div>
        <div class="floating-particle"></div>
        <div class="floating-particle"></div>

        <div class="login-container animate__animated animate__fadeInUp">
            <div class="logo-section animate__animated animate__fadeInDown animate__delay-1s">
                <div class="logo">LOTUS</div>
                <div class="tagline">Experiência gastronômica Oriental única</div>
            </div>

            <div class="welcome-text animate__animated animate__fadeIn animate__delay-2s">
                Bem-vindo de volta
            </div>
            <div class="subtitle animate__animated animate__fadeIn animate__delay-2s">
                Faça login para continuar sua jornada gastronômica
            </div>

            <div class="error-message" id="errorMessage"></div>

            <livewire:login-form />

            <div class="signup-link animate__animated animate__fadeIn animate__delay-6s">
                Não tem uma conta? <a href="{{ route('registro') }}">Criar conta</a>
            </div>
        </div>

        <script src="{{ asset('assets/js/login.js') }}"></script>
        @livewireScripts
    </div>
</body>

</html>