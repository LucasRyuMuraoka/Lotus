function registerUser(e) {
  e.preventDefault();

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  if (password.length < 6) {
    alert("A senha deve ter no mínimo 6 caracteres.");
    return;
  }

  // Simulação de registro (você precisará de um backend real para isso)
  const usuariosCadastrados = {
    "usuario1@email.com": "senha123",
    "admin@email.com": "admin123",
    "teste@email.com": "teste456"
  };

  if (usuariosCadastrados.hasOwnProperty(email)) {
    alert("Este email já está cadastrado.");
    return;
  }

  // Simulação de sucesso no cadastro
  alert(`Conta criada com sucesso para ${email}!`);
  // Aqui você normalmente enviaria os dados para um servidor e, após o sucesso,
  // redirecionaria o usuário para a página de login ou principal.
  window.location.href = "login.html";
}

const registerForm = document.getElementById('registerForm');
if (registerForm) {
  registerForm.addEventListener('submit', registerUser);
}