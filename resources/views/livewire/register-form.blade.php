<form wire:submit.prevent="register" id="signupForm">
    <div class="form-group animate__animated animate__fadeInUp animate__delay-2s">
        <label class="form-label" for="firstName">Nome</label>
        <input wire:model.defer="name" type="text" id="firstName" name="firstName" class="form-input" placeholder="Seu nome" required>
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group animate__animated animate__fadeInUp animate__delay-3s">
        <label class="form-label" for="email">E-mail</label>
        <input wire:model.defer="email" type="email" id="email" name="email" class="form-input" placeholder="seu@email.com" required>
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-row">
        <div class="form-group animate__animated animate__fadeInLeft animate__delay-4s">
            <label class="form-label" for="password">Senha</label>
            <input wire:model.defer="password" type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group animate__animated animate__fadeInRight animate__delay-4s">
            <label class="form-label" for="confirmPassword">Confirmar Senha</label>
            <input wire:model.defer="password_confirmation" type="password" id="confirmPassword" name="confirmPassword" class="form-input" placeholder="••••••••" required>
        </div>
    </div>

    <button type="submit" class="submit-btn animate__animated animate__fadeInUp animate__delay-5s">
        Criar Conta
    </button>
</form>
