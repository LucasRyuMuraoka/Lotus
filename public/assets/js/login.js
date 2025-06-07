let passwordVisible = false;

function togglePassword() {
  const passwordInput = document.getElementById("password");
  const toggleIcon = document.querySelector(".password-toggle");

  if (passwordVisible) {
    passwordInput.type = "password";
    toggleIcon.textContent = "👁️";
    passwordVisible = false;
  } else {
    passwordInput.type = "text";
    toggleIcon.textContent = "🙈";
    passwordVisible = true;
  }
}

/*

function showError(message) {
  const errorDiv = document.getElementById("errorMessage");
  errorDiv.textContent = message;
  errorDiv.style.display = "block";
  errorDiv.classList.add("animate__animated", "animate__shakeX");

  setTimeout(() => {
    errorDiv.classList.remove("animate__shakeX");
  }, 1000);
}

function hideError() {
  const errorDiv = document.getElementById("errorMessage");
  errorDiv.style.display = "none";
}

// Validação do formulário
document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();
  hideError();

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // Validação básica
  if (!email || !password) {
    showError("Por favor, preencha todos os campos.");
    return;
  }

  if (!email.includes("@")) {
    showError("Por favor, insira um e-mail válido.");
    return;
  }

  // Simulação de login
  const button = e.target.querySelector(".login-btn");
  const originalText = button.textContent;

  button.textContent = "Entrando...";
  button.style.background =
    "linear-gradient(135deg, var(--warning-color) 0%, #f57c00 100%)";
  button.disabled = true;

  setTimeout(() => {
    // Simulação de credenciais
    if (email === "admin@lotus.com" && password === "123456") {
      button.textContent = "Sucesso!";
      button.style.background =
        "linear-gradient(135deg, var(--success-color) 0%, #45a049 100%)";

      setTimeout(() => {
        alert("Login realizado com sucesso! Bem-vindo ao Lotus!");
        // Aqui você redirecionaria para o dashboard
      }, 1000);
    } else {
      showError("E-mail ou senha incorretos. Tente novamente.");
      button.textContent = originalText;
      button.style.background =
        "linear-gradient(135deg, var(--primary-color) 0%, #e53e3a 100%)";
      button.disabled = false;
    }
  }, 2000);
});

// Efeitos de foco nos inputs
document.querySelectorAll(".form-input").forEach((input) => {
  input.addEventListener("focus", function () {
    this.parentElement.style.transform = "scale(1.02)";
    this.parentElement.style.transition = "transform 0.3s ease";
  });

  input.addEventListener("blur", function () {
    this.parentElement.style.transform = "scale(1)";
  });
});

// Auto-hide error message quando o usuário começar a digitar
document.querySelectorAll(".form-input").forEach((input) => {
  input.addEventListener("input", hideError);
});

function forgotPassword() {
  const email = document.getElementById("email").value;
  if (email) {
    alert(`Instruções de recuperação de senha foram enviadas para: ${email}`);
  } else {
    alert(
      'Por favor, insira seu e-mail primeiro e depois clique em "Esqueci minha senha".'
    );
    document.getElementById("email").focus();
  }
}

// Easter egg: credenciais de demonstração
document.addEventListener("keydown", function (e) {
  if (e.ctrlKey && e.shiftKey && e.key === "D") {
    alert(
      "Credenciais de demonstração:\nE-mail: admin@lotus.com\nSenha: 123456"
    );
  }
});
*/
