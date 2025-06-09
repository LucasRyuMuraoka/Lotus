<form wire:submit.prevent="login" id="loginForm">
    <div class="login-form-group animate__animated animate__fadeInLeft animate__delay-3s">
        <label class="login-form-label" for="email">E-mail</label>
        <input wire:model.defer="email" type="email" id="email" name="email" class="login-form-input" placeholder="seu@email.com" required />
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="login-form-group animate__animated animate__fadeInRight animate__delay-3s">
        <label class="login-form-label" for="password">Senha</label>
        <input wire:model.defer="password" type="password" id="password" name="password" class="login-form-input" placeholder="••••••••" required />
        <span class="login-password-toggle" onclick="togglePassword()">👁️</span>
        @error('password') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div
        class="login-form-options animate__animated animate__fadeIn animate__delay-4s">
        <div class="login-remember-me" hidden>
            <input type="checkbox" id="remember" name="remember" class="login-checkbox" hidden />
            <label for="remember" class="login-checkbox-label" hidden>Lembrar de mim</label>
        </div>
        <a href="#" class="login-forgot-password" onclick="forgotPassword()" hidden>Esqueci minha senha</a>
    </div>

    <button type="submit" class="login-btn animate__animated animate__fadeInUp animate__delay-5s">
        Entrar
    </button>
</form>
