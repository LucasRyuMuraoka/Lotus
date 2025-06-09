<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Lotus - Edição de Usuário</title>
    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/editar-usuarios.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="{{ Asset('/assets/images/tori-icon.jpg') }}" />

    @livewireStyles
</head>

<body>

    @livewire('admin-header')

    <main class="admin-main">
        <section class="admin-hero">
            <div class="hero-content">
                <h1 class="animate__animated animate__fadeInDown">
                    Editar <span>Usuário</span>
                </h1>
                <p class="animate__animated animate__fadeIn animate__delay-1s">
                    Modifique os dados do usuário selecionado.
                </p>
            </div>
        </section>
        <section class="admin-content">
            <div class="admin-form">
                <h2>Editando Usuário:</h2>
                <form id="editar-usuario-form" method="post" action="/users/{{ $user->id }}">
                    @method('PUT')
                    @csrf
                    {{-- <input type="hidden" id="usuario-id" name="usuario-id"> --}}
                    <div class="form-group">
                        <label for="nome-completo">Nome:</label>
                        <input type="text" id="nome-completo" name="name" required value="{{ $user->name }}">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required value="{{ $user->email }}" disabled>
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="tipo-usuario">Tipo de Usuário:</label>
                        <select id="tipo-usuario" name="role" required>
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Cliente</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('role') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nova-senha">Nova Senha:</label>
                        <input type="password" id="nova-senha" name="password" minlength="5">
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirmar-nova-senha">Confirmar Nova Senha:</label>
                        <input type="password" id="confirmar-nova-senha" name="password_confirmation" minlength="5">
                    </div>
                    <button type="submit" class="edit-button">Salvar Alterações</button>
                    <a href="{{ route('usuarios') }}" class="btn-cancelar">Cancelar</a>
                </form>
            </div>
        </section>
    </main>

    <div class="pre-footer-line"></div>

    @livewire('admin-footer')

    @livewireScripts
</body>

</html>