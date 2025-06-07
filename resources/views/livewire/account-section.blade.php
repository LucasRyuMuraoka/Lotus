<section class="c-section-account">
    <div class="account-tabs">
        <button wire:click="setTab('perfil')" class="account-tab-btn {{ $tab === 'perfil' ? 'active' : '' }}" data-tab="perfil">Meu Perfil</button>
        <button wire:click="setTab('pedidos')" class="account-tab-btn {{ $tab === 'pedidos' ? 'active' : '' }}" data-tab="pedidos">Meus Pedidos</button>
    </div>

    <div class="account-content">

        @if($tab === 'perfil')
        <div class="account-tab-content active" id="perfil">
            <h2>Dados Pessoais</h2>
            <p>Atualize suas informações de cadastro.</p>

            <div class="profile-form-container">

                <div class="profile-avatar">
                    <div class="avatar-image">
                        <img
                            src="assets/images/user-avatar.png"
                            alt="Avatar do usuário" />
                    </div>
                    <button class="avatar-change-btn">Alterar foto</button>
                </div>

                <form wire:submit.prevent="save" class="profile-form">
                    <div class="form-section">
                        <h3>Informações Básicas</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nome completo*</label>
                                <input wire:model.defer="name" type="text" id="name" name="name" value="{{ $name }}" required />
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF*</label>
                                <input wire:model.defer="cpf" type="text" id="cpf" name="cpf" value="{{ $cpf }}" />
                                @error('cpf') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="data-nasc">Data de nascimento*</label>
                                <input wire:model.defer="birthDate" type="date" id="data-nasc" name="data-nasc" value="{{ $birthDate }}" />
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone*</label>
                                <input wire:model.defer="phone" type="tel" id="telefone" name="telefone" value="{{ $phone }}" />
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>Dados de Acesso</h3>
                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="email">E-mail*</label>
                                <input wire:model.defer="email" type="email" id="email" name="email" value="{{ $email }}" required disabled />
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="senha-atual">Senha atual</label>
                                <input type="password" id="senha-atual" name="senha-atual" placeholder="••••••••" />
                            </div>
                            <div class="form-group">
                                <label for="nova-senha">Nova senha</label>
                                <input type="password" id="nova-senha" name="nova-senha" placeholder="••••••••" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="confirmar-senha">Confirmar nova senha</label>
                                <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="••••••••" />
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>Preferências</h3>
                        <div class="form-row preferences">
                            <div class="form-group full-width">
                                <label>Preferências alimentares (selecione todas que se
                                    aplicam)</label>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="vegan" name="preferencias" value="vegan" />
                                        <label for="vegan">Vegano</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="vegetarian" name="preferencias" value="vegetarian" checked />
                                        <label for="vegetarian">Vegetariano</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="gluten-free" name="preferencias" value="gluten-free" />
                                        <label for="gluten-free">Sem Glúten</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="lactose-free" name="preferencias" value="lactose-free" checked />
                                        <label for="lactose-free">Sem Lactose</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="alergias">Alergias ou restrições alimentares</label>
                                <textarea id="alergias" name="alergias" rows="3" placeholder="Informe suas alergias ou restrições alimentares"> Alergia a camarão</textarea>
                            </div>
                        </div>

                        <div class="form-row notification-prefs">
                            <div class="form-group full-width">
                                <label>Notificações</label>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="notif-email" name="notificacoes" value="email" checked />
                                        <label for="notif-email">Receber notificações por e-mail</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="notif-sms" name="notificacoes" value="sms" checked />
                                        <label for="notif-sms">Receber notificações por SMS</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="notif-whatsapp" name="notificacoes" value="whatsapp" checked />
                                        <label for="notif-whatsapp">Receber notificações por WhatsApp</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="notif-promo" name="notificacoes" value="promos" checked />
                                        <label for="notif-promo">Receber promoções e novidades</label>
                                    </div>
                                </div>
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
</section>
