document.addEventListener('DOMContentLoaded', function() {
    // Aguarda o Livewire carregar completamente
    document.addEventListener('livewire:initialized', function() {
        Livewire.on('show-notification', function(data) {
            showNotification(data[0].message, data[0].type, data[0].duration);
        });
    });
    
    // Fallback caso o evento acima não funcione
    setTimeout(() => {
        if (typeof Livewire !== 'undefined') {
            Livewire.on('show-notification', function(data) {
                showNotification(data[0].message, data[0].type, data[0].duration);
            });
        }
    }, 1000);
});

function showNotification(message, type = 'success', duration = 4000) {
    const popup = document.getElementById('notificationPopup');
    const messageEl = document.getElementById('notificationMessage');
    const iconEl = document.getElementById('notificationIcon');
    
    if (!popup || !messageEl || !iconEl) {
        console.error('Elementos do popup não encontrados');
        return;
    }
    
    messageEl.textContent = message;
    iconEl.textContent = type === 'success' ? '✓' : '⚠';
    
    popup.className = `admpratos-notification-popup ${type} show`;
    
    setTimeout(() => {
        hideNotification();
    }, duration);
}

function hideNotification() {
    const popup = document.getElementById('notificationPopup');
    if (popup) {
        popup.classList.remove('show');
    }
}