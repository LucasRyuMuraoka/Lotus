// Validação do formulário
/*
document.getElementById('signupForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;

  if (password !== confirmPassword) {
    alert('As senhas não coincidem!');
    return;
  }

  if (password.length < 6) {
    alert('A senha deve ter pelo menos 6 caracteres!');
    return;
  }

  // Animação de sucesso
  const button = e.target.querySelector('.submit-btn');
  button.textContent = 'Criando conta...';
  button.style.background = 'linear-gradient(135deg, #4caf50 0%, #45a049 100%)';

  setTimeout(() => {
    alert('Conta criada com sucesso! Bem-vindo ao Lotus!');
    button.textContent = 'Conta Criada!';
  }, 2000);
});
*/

// Efeitos de foco nos inputs
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', function () {
        this.parentElement.style.transform = 'scale(1.02)';
    });

    input.addEventListener('blur', function () {
        this.parentElement.style.transform = 'scale(1)';
    });
});
