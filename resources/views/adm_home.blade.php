<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Lotus - Painel de Administração</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/adm-home.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="icon" href="{{ Asset('/assets/images/tori-icon.jpg') }}" />


  @livewireStyles
</head>

<body>

  @livewire('admin-header')

  <main class="admhome-admin-main">
    <section class="admhome-admin-hero">
      <div class="admhome-hero-content">
        <h1 class="animate__animated animate__fadeInDown">
          Bem-vindo ao <span>Painel Lotus</span>
        </h1>
        <p class="animate__animated animate__fadeIn animate__delay-1s">
          Gerencie o conteúdo de forma fácil e rápida.
        </p>
      </div>
    </section>

    <section class="admhome-admin-content admin-home-content">
      <div class="quick-access-cards">
        <a href="{{ route('pratos') }}" class="card-link">
          <div class="access-card">
            <img src="{{ asset('assets/images/menu-icon.png') }}" alt="Ícone Pratos" class="card-icon">
            <h3>Gerenciar Pratos</h3>
            <p>Adicionar, editar ou remover pratos do cardápio.</p>
          </div>
        </a>
        <a href="{{ route('usuarios') }}" class="card-link">
          <div class="access-card">
            <img src="{{ asset('assets/images/user-mana-icon.png') }}" alt="Ícone Usuários" class="card-icon">
            <h3>Gerenciar Usuários</h3>
            <p>Adicionar, editar ou remover usuários do sistema.</p>
          </div>
        </a>
      </div>
    </section>
  </main>


  <div class="pre-footer-line"></div>

  @livewire('admin-footer')

  @livewireScripts
</body>

</html>