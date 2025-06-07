<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/conta.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/perfil.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <title>Meu Perfil - Lotus</title>
    @livewireStyles
</head>

<body>

    @livewire('customer-header')

    <main class="account-main">
        <section class="account-section-hero">
            <div class="account-hero-content">
                <h1 class="animate__animated animate__fadeInDown">
                    Meu <span>Perfil</span>
                </h1>
                <p class="animate__animated animate__fadeIn animate__delay-1s">
                    Gerencie seus dados pessoais e acompanhe o histórico de pedidos.
                </p>
            </div>
        </section>

        <livewire:account-section />

        <section class="c-section-help">
            <div class="account-help-content">
                <h2>Precisa de <span>ajuda</span>?</h2>
                <div class="account-help-options">
                    <div class="account-help-option">
                        <div class="account-help-icon">
                            <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" alt="Atendimento" width="40" />
                        </div>
                        <h3>Atendimento</h3>
                        <p>Fale com um de nossos atendentes online.</p>
                        <a href="#" class="account-help-btn">Acessar</a>
                    </div>
                    <div class="account-help-option">
                        <div class="account-help-icon">
                            <img src="https://cdn-icons-png.flaticon.com/512/4712/4712139.png" alt="FAQ" width="40" />
                        </div>
                        <h3>FAQ</h3>
                        <p>Confira as perguntas mais frequentes.</p>
                        <a href="#" class="account-help-btn">Acessar</a>
                    </div>
                    <div class="account-help-option">
                        <div class="account-help-icon">
                            <img
                                src="https://cdn-icons-png.flaticon.com/512/1384/1384023.png"
                                alt="WhatsApp"
                                width="40" />
                        </div>
                        <h3>WhatsApp</h3>
                        <p>Envie sua dúvida por WhatsApp.</p>
                        <a href="#" class="account-help-btn">Enviar</a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <div class="pre-footer-line"></div>
    @livewire('customer-footer')

    {{-- <script src="{{ asset('assets/js/perfil.js') }}"></script> --}}
    @livewireScripts
</body>

</html>
