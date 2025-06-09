<section class="profile-c-section-account">
    <div class="profile-account-tabs">
        <button wire:click="setTab('perfil')" class="profile-account-tab-btn {{ $tab === 'perfil' ? 'active' : '' }}"
            data-tab="perfil">Meu Perfil</button>
        <button wire:click="setTab('pedidos')" class="profile-account-tab-btn {{ $tab === 'pedidos' ? 'active' : '' }}"
            data-tab="pedidos">Meus Pedidos</button>
    </div>

    <div class="profile-account-content">

        @if($tab === 'perfil')
            <div class="profile-account-tab-content active" id="perfil">

                <h2 class="profile-p-title-form">Dados Pessoais</h2>
                <p class="profile-p-subtitle-form">Atualize suas informações de cadastro.</p>

                @if (session()->has('success'))
                    <div class="profile-notification success show">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="profile-notification error show">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="profile-form-container">

                    <form wire:submit.prevent="save" class="profile-form">
                        <div class="profile-form-section">
                            <h3>Informações Básicas</h3>
                            <div class="profile-form-row">
                                <div class="profile-form-group">
                                    <label for="name">Nome*</label>
                                    <input wire:model.defer="name" type="text" id="name" name="name" value="{{ $name }}"
                                        required />
                                    @error('name') <span class="error">{{ $message ?? '' }}</span> @enderror
                                </div>
                                <div class="profile-form-group">
                                    <label for="cpf">CPF*</label>
                                    <input wire:model.defer="cpf" type="text" id="cpf" name="cpf" value="{{ $cpf }}" />
                                    @error('cpf') <span class="error">{{ $message ?? '' }}</span> @enderror
                                </div>
                            </div>

                            <div class="profile-form-row">
                                <div class="profile-form-group">
                                    <label for="data-nasc">Data de nascimento*</label>
                                    <input wire:model.defer="birthDate" type="date" id="data-nasc" name="data-nasc"
                                        value="{{ $birthDate }}" />
                                    @error('birthDate') <span class="error">{{ $message ?? '' }}</span> @enderror
                                </div>
                                <div class="profile-form-group">
                                    <label for="telefone">Telefone*</label>
                                    <input wire:model.defer="phone" type="tel" pattern="^\(\d{2}\)\s\d{4,5}-\d{4}$" placeholder="(11) 12345-6789" id="telefone" name="telefone"
                                        value="{{ $phone }}" />
                                    @error('phone') <span class="error">{{ $message ?? '' }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="profile-form-section">
                            <h3>Dados de Acesso</h3>
                            <div class="profile-form-row">
                                <div class="profile-form-group full-width">
                                    <label for="email">E-mail*</label>
                                    <input wire:model.defer="email" type="email" id="email" name="email"
                                        value="{{ $email }}" required disabled />
                                    @error('email') <span class="error">{{ $message ?? '' }}</span> @enderror
                                </div>
                            </div>
                            <div class="profile-form-row">
                                <div class="profile-form-group">
                                    <label for="nova-senha">Nova senha</label>
                                    <input wire:model.defer="password" type="password" id="nova-senha" name="nova-senha" placeholder="••••••••" />
                                    @error('password') <span class="error">{{ $message ?? '' }}</span> @enderror
                                </div>
                            </div>

                            <div class="profile-form-row">
                                <div class="profile-form-group full-width">
                                    <label for="confirmar-senha">Confirmar nova senha</label>
                                    <input wire:model.defer="password_confirmation" type="password" id="confirmar-senha" name="confirmar-senha"
                                        placeholder="••••••••" />
                                </div>
                            </div>
                        </div>

                        <div class="profile-form-actions">
                            <button wire:click="cancel" type="button" class="profile-btn-secondary">Cancelar</button>
                            <button type="submit" class="profile-btn-primary">Salvar alterações</button>
                        </div>
                    </form>

                </div>

                <div class="profile-account-delete-section">
                    <h3>Excluir conta</h3>
                    <p>
                        Ao excluir sua conta, todos os seus dados e histórico de pedidos
                        serão removidos permanentemente.
                    </p>
                    <button @click="if (confirm('Tem certeza que deseja excluir sua conta?')) { $wire.deleteAccount() }"
                        class="profile-btn-delete">Excluir minha conta</button>
                </div>
            </div>
        @elseif($tab === 'pedidos')

            <livewire:order-section />

        @endif

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notifications = document.querySelectorAll('.profile-notification.show');
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
