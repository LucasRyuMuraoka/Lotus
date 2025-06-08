<header class="header">
    <div class="h-logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" title="logo" class="logo">
        </a>
    </div>
    <nav class="h-nav">
        <ul class="n-menu">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Painel Admin</a></li>
            <li><a href="{{ route('pratos') }}" class="{{ request()->routeIs('pratos') ? 'active' : '' }}">Gerenciar Pratos</a></li>
            <li><a href="{{ route('usuarios') }}" class="{{ request()->routeIs('usuarios') ? 'active' : '' }}">Gerenciar Usuários</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            </li>
        </ul>
    </nav>
</header>
