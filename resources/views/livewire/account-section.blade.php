<section class="c-section-account">
    <div class="account-tabs">
        <button wire:click="setTab('perfil')" class="account-tab-btn {{ $tab === 'perfil' ? 'active' : '' }}"
            data-tab="perfil">Meu Perfil</button>
        <button wire:click="setTab('pedidos')" class="account-tab-btn {{ $tab === 'pedidos' ? 'active' : '' }}"
            data-tab="pedidos">Meus Pedidos</button>
    </div>

    <div class="account-content">

        @if($tab === 'perfil')
            <div class="account-tab-content active" id="perfil">

                <h2 class="p-title-form">Dados Pessoais</h2>
                <p class="p-subtitle-form">Atualize suas informações de cadastro.</p>

                @if (session()->has('success'))
                    <div class="notification success show">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="notification error show">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="profile-form-container">

                    <form wire:submit.prevent="save" class="profile-form">
                        <div class="form-section">
                            <h3>Informações Básicas</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Nome*</label>
                                    <input wire:model.defer="name" type="text" id="name" name="name" value="{{ $name }}"
                                        required />
                                    @error('name') <span class="error">{{ $message ?? '' }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cpf">CPF*</label>
                                    <input wire:model.defer="cpf" type="text" id="cpf" name="cpf" value="{{ $cpf }}" />
                                    @error('cpf') <span class="error">{{ $message ?? '' }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="data-nasc">Data de nascimento*</label>
                                    <input wire:model.defer="birthDate" type="date" id="data-nasc" name="data-nasc"
                                        value="{{ $birthDate }}" />
                                </div>
                                <div class="form-group">
                                    <label for="telefone">Telefone*</label>
                                    <input wire:model.defer="phone" type="tel" id="telefone" name="telefone"
                                        value="{{ $phone }}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Dados de Acesso</h3>
                            <div class="form-row">
                                <div class="form-group full-width">
                                    <label for="email">E-mail*</label>
                                    <input wire:model.defer="email" type="email" id="email" name="email"
                                        value="{{ $email }}" required />
                                    @error('email') <span class="error">{{ $message ?? '' }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nova-senha">Nova senha</label>
                                    <input type="password" id="nova-senha" name="nova-senha" placeholder="••••••••" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group full-width">
                                    <label for="confirmar-senha">Confirmar nova senha</label>
                                    <input type="password" id="confirmar-senha" name="confirmar-senha"
                                        placeholder="••••••••" />
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button wire:click="cancel" type="button" class="btn-secondary">Cancelar</button>
                            <button type="submit" class="btn-primary">Salvar alterações</button>
                        </div>
                    </form>

                </div>

                <div class="account-delete-section">
                    <h3>Excluir conta</h3>
                    <p>
                        Ao excluir sua conta, todos os seus dados e histórico de pedidos
                        serão removidos permanentemente.
                    </p>
                    <button wire:click="deleteAccount" class="btn-delete">Excluir minha conta</button>
                </div>
            </div>
        @elseif($tab === 'pedidos')

            <livewire:order-section />

        @endif

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notifications = document.querySelectorAll('.notification.show');
            notifications.forEach(function (notification) {
                setTimeout(function () {
                    notification.classList.remove('show');
                }, 4000);
            });
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('refreshPage', () => {
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            });
        });
    </script>
</section>