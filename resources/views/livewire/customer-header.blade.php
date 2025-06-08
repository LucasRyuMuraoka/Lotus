<header class="header">
    <div class="h-logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" title="logo" class="logo">
        </a>
    </div>

    <nav class="h-nav">
        <ul class="n-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('cardapio') }}" class="{{ request()->routeIs('cardapio') ? 'active' : '' }}">Cardápio</a></li>
            <li><a href="{{ route('carrinho') }}" class="{{ request()->routeIs('carrinho') ? 'active' : '' }}">Carrinho</a></li>

            @auth
            {{-- If user is logged --}}

            @if(auth()->user()->role === 'customer')
            <li><a href="{{ route('conta') }}" class="{{ request()->routeIs('conta') ? 'active' : '' }}">Conta</a></li>

            @elseif(auth()->user()->role === 'admin')
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>

            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            </li>

            @endauth

            @guest
            <li><a href="{{ route('entrar') }}">Login</a></li>
            @endguest
        </ul>
    </nav>
</header>
