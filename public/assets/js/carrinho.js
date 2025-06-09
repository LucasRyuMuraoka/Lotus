function showNotification(message, type = 'success', duration = 4000) {
    const existingPopup = document.querySelector('.notification-popup');
    if (existingPopup) {
        existingPopup.remove();
    }

    const popup = document.createElement('div');
    popup.className = `notification-popup ${type}`;
    
    const icon = type === 'success' ? '✓' : '⚠';
    
    const displayMessage = message || 'Operação realizada com sucesso!';
    
    popup.innerHTML = `
        <span class="icon">${icon}</span>
        <span class="message">${displayMessage}</span>
        <button class="close-btn" onclick="closeNotification(this.parentElement)">&times;</button>
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
    if (popup && popup.classList.contains('notification-popup')) {
        popup.classList.remove('show');
        setTimeout(() => {
            if (popup.parentNode) {
                popup.parentNode.removeChild(popup);
            }
        }, 300); 
    }
}

document.addEventListener('livewire:initialized', () => {
    Livewire.on('show-notification', (event) => {
        // Garante compatibilidade com diferentes versões do Livewire
        const data = event.detail ? event.detail : event;
        const message = data.message || data[0]?.message || 'Operação realizada!';
        const type = data.type || data[0]?.type || 'success';
        const duration = data.duration || data[0]?.duration || 4000;
        
        showNotification(message, type, duration);
    });
});