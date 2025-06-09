function showNotification(message, type = "success", duration = 4000) {
    const existingPopup = document.querySelector(".signup-notification-popup");
    if (existingPopup) {
        existingPopup.remove();
    }

    const popup = document.createElement("div");
    popup.className = `signup-notification-popup ${type}`;

    const icon = type === "success" ? "✓" : "⚠";

    const displayMessage = message || "Operação realizada com sucesso!";

    popup.innerHTML = `
        <span class="signup-icon">${icon}</span>
        <span class="signup-message">${displayMessage}</span>
        <button class="signup-close-btn" onclick="closeNotification(this.parentElement)">&times;</button>
    `;

    document.body.appendChild(popup);

    setTimeout(() => {
        popup.classList.add("show");
    }, 100);

    setTimeout(() => {
        closeNotification(popup);
    }, duration);
}

function closeNotification(popup) {
    if (popup && popup.classList.contains("signup-notification-popup")) {
        popup.classList.remove("show");
        setTimeout(() => {
            if (popup.parentNode) {
                popup.parentNode.removeChild(popup);
            }
        }, 300);
    }
}

// Event listener para Livewire
document.addEventListener("livewire:initialized", () => {
    Livewire.on("show-notification", (event) => {
        const data = event.detail ? event.detail : event;
        const message =
            data.message || data[0]?.message || "Operação realizada!";
        const type = data.type || data[0]?.type || "success";
        const duration = data.duration || data[0]?.duration || 5000;

        showNotification(message, type, duration);
    });
});

document.querySelectorAll(".signup-form-input").forEach((input) => {
    input.addEventListener("focus", function () {
        this.parentElement.style.transform = "scale(1.02)";
    });

    input.addEventListener("blur", function () {
        this.parentElement.style.transform = "scale(1)";
    });
});
