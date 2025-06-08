<form wire:submit.prevent="login" id="loginForm">
    <div class="form-group animate__animated animate__fadeInLeft animate__delay-3s">
        <label class="form-label" for="email">E-mail</label>
        <input wire:model.defer="email" type="email" id="email" name="email" class="form-input" placeholder="seu@email.com" required />
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group animate__animated animate__fadeInRight animate__delay-3s">
        <label class="form-label" for="password">Senha</label>
        <input wire:model.defer="password" type="password" id="password" name="password" class="form-input" placeholder="••••••••" required />
        <span class="password-toggle" onclick="togglePassword()">👁️</span>
        @error('password') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div
        class="form-options animate__animated animate__fadeIn animate__delay-4s">
        <div class="remember-me" hidden>
            <input type="checkbox" id="remember" name="remember" class="checkbox" hidden />
            <label for="remember" class="checkbox-label" hidden>Lembrar de mim</label>
        </div>
        <a href="#" class="forgot-password" onclick="forgotPassword()" hidden>Esqueci minha senha</a>
    </div>

    <button type="submit" class="login-btn animate__animated animate__fadeInUp animate__delay-5s">
        Entrar
    </button>
</form>
