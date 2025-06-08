<section class="admin-content">

    <div class="admin-form">
        <h2>Adicionar Novo Usuário</h2>
        <form wire:submit.prevent="save" id="usuario-form">
            <div class="form-group">
                <label for="nome-completo">Nome:</label>
                <input wire:model.defer="name" type="text" id="nome-completo" name="nome-completo" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input wire:model.defer="email" type="email" id="email" name="email" required>
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input wire:model.defer="password" type="password" id="senha" name="senha" required>
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="confirmar-senha">Confirmar Senha:</label>
                <input wire:model.defer="password_confirmation" type="password" id="confirmar-senha" name="confirmar-senha" required>
            </div>
            <div class="form-group">
                <label for="tipo-usuario">Tipo de Usuário:</label>
                <select wire:model.defer="role" id="tipo-usuario" name="tipo-usuario" required>
                    <option value="customer">Customer</option>
                    <option value="admin">Administrador</option>
                </select>
                @error('role') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit">Adicionar Usuário</button>
        </form>
    </div>

    <div class="admin-lista">
        <h2>Usuários Existentes</h2>
        <ul id="usuarios-lista">
            @if (session()->has('message'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                class="alert" style="color: white">
                {{ session('message') }}
            </div>
            @endif
            @forelse($users as $user)
            <li>
                <span>{{ $user->name }}</span>
                <div class="acoes">
                    <button class="editar"
                        @click="window.location.href='/users/{{ $user->id }}/edit'">
                        Editar</button> |
                    <button class="excluir"
                        @click="if (confirm('Tem certeza que deseja excluir este usuário?')) { $wire.delete({{ $user->id }}) }">
                        Excluir
                    </button>
                </div>
            </li>
            @empty
            <li>Nenhum usuário cadastrado</li>
            @endforelse
        </ul>
    </div>

</section>
