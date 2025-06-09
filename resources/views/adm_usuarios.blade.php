<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Lotus - Gerenciar Usuários</title>
  <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/adm-usuarios.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="icon" href="{{ asset('/assets/images/torii gate guia logo.jpg') }}">

  @livewireStyles
</head>

<body>

    @livewire('admin-header')

  <main class="admin-main">

    <section class="admin-hero">
      <div class="hero-content">
        <h1 class="animate__animated animate__fadeInDown">
          Gerenciar <span>Usuários</span>
        </h1>
        <p class="animate__animated animate__fadeIn animate__delay-1s">
          Adicione novos usuários ao sistema ou edite os existentes.
        </p>
      </div>
    </section>

    <livewire:admin-user-section />

  </main>

  <div class="pre-footer-line"></div>

  @livewire('admin-footer')

  {{-- <script src="{{ asset('assets/js/adm_usuarios.js') }}"></script> --}}

  @livewireScripts
</body>

</html>