<header class="header">
    <div class="h-logo">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" title="logo" class="logo" />
    </div>
    <nav class="h-nav">
        <ul class="n-menu">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Home do ADM</a></li>
            <li><a href="{{ route('pratos') }}">Criar Pratos</a></li>
            <li><a href="{{ route('usuarios') }}">Gerenciar Usuários</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            </li>
        </ul>
    </nav>
</header>
