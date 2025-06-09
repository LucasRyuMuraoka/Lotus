let passwordVisible = false;

function togglePassword() {
  const passwordInput = document.getElementById("password");
  const toggleIcon = document.querySelector(".login-password-toggle");

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

function showNotification(message, type = 'success', duration = 4000) {
    const existingPopup = document.querySelector('.login-notification-popup');
    if (existingPopup) {
        existingPopup.remove();
    }

    const popup = document.createElement('div');
    popup.className = `login-notification-popup ${type}`;
    
    const icon = type === 'success' ? '✓' : '⚠';
    
    const displayMessage = message || 'Operação realizada com sucesso!';
    
    popup.innerHTML = `
        <span class="login-icon">${icon}</span>
        <span class="login-message">${displayMessage}</span>
        <button class="login-close-btn" onclick="closeNotification(this.parentElement)">&times;</button>
    `;

    document.body.appendChild(popup);

    setTimeout(() => {
        popup.classList.add('show');
    }, 100);

    setTimeout(() => {
        closeNotification(popup);
    }, duration);
}

function closeNotification(popup) {
    if (popup && popup.classList.contains('login-notification-popup')) {
        popup.classList.remove('show');
        setTimeout(() => {
            if (popup.parentNode) {
                popup.parentNode.removeChild(popup);
            }
        }, 300);
    }
}

// Event listener para Livewire
document.addEventListener('livewire:initialized', () => {
    Livewire.on('show-notification', (event) => {
        const data = event.detail ? event.detail : event;
        const message = data.message || data[0]?.message || 'Operação realizada!';
        const type = data.type || data[0]?.type || 'success';
        const duration = data.duration || data[0]?.duration || 5000;
        
        showNotification(message, type, duration);
    });
});