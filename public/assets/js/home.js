// Aguarde que todo o conteúdo seja carregado antes de inicializar o Swiper
document.addEventListener('DOMContentLoaded', function () {
    // Cria uma nova instancia do objeto Swiper
    const swiper = new Swiper('.swiper', {
        // Direção do deslizamento
        direction: 'horizontal',

        // Loop infinito
        loop: true,

        // Ajusta o deslizamento automático
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },

        // Efeito de transição
        effect: 'coverflow',
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 1.5,
            slideShadows: false,
        },

        // Controles de paginação
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },

        // Ajusta o menu de navegação
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // Velocidade de transição e cursor
        speed: 1000, // Reduzido de 4000 para uma experiência mais agradável
        grabCursor: true,
    });

    // Adicionar classes de animação aos elementos quando entrarem na visualização
    const animateElements = document.querySelectorAll('.animate__animated');

    // Função para verificar se um elemento está visível na tela
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Função para adicionar animações quando elementos se tornarem visíveis
    function checkAnimations() {
        animateElements.forEach(element => {
            if (isElementInViewport(element) && !element.classList.contains('animate__showed')) {
                element.classList.add('animate__showed');
            }
        });
    }

    // Verificar animações no carregamento da página e durante a rolagem
    window.addEventListener('scroll', checkAnimations);
    window.addEventListener('resize', checkAnimations);
    checkAnimations(); // Verificar no carregamento inicial
});

function showPrivacyConfirm() {
    // Verifica se o usuário já fez uma escolha sobre a política de privacidade
    if (localStorage.getItem('privacyChoice') !== 'accepted') {

        // Pergunta única com opções
        const userResponse = confirm(
            "Este site utiliza cookies para melhorar sua experiência.\n\n" +
            "Clique em 'OK' para aceitar os cookies.\n" +
            "Clique em 'Cancelar' para acessar nossa Política de Privacidade antes de decidir."
        );

        if (userResponse) {
            // Usuário aceitou diretamente
            localStorage.setItem('privacyChoice', 'accepted');
            console.log('Cookies aceitos diretamente');
        } else {
            // Usuário quer ver a política primeiro
            try {
                // Tenta abrir a política de privacidade em nova aba
                const newWindow = window.open('./politica_privacidade', '_blank');

                if (newWindow) {
                    // Aguarda um pouco para dar tempo do usuário ler
                    setTimeout(() => {
                        const finalDecision = confirm(
                            "Após conhecer nossa Política de Privacidade, você aceita o uso de cookies?\n\n" +
                            "Clique em 'OK' para aceitar ou 'Cancelar' para recusar."
                        );

                        if (finalDecision) {
                            localStorage.setItem('privacyChoice', 'accepted');
                            console.log('Cookies aceitos após consulta à política');
                        } else {
                            localStorage.setItem('privacyChoice', 'declined');
                            console.log('Cookies recusados após consulta à política');
                        }
                    }, 3000);
                } else {
                    // Se não conseguiu abrir nova aba, redireciona na mesma página
                    alert("Redirecionando para nossa Política de Privacidade...");
                    window.location.href = './politica_privacidade';
                }
            } catch (error) {
                // Em case de erro, redireciona diretamente
                console.error('Erro ao abrir política de privacidade:', error);
                alert("Redirecionando para nossa Política de Privacidade...");
                window.location.href = './politica_privacidade';
            }
        }
    }
}

// Chamar a função após carregar a página
document.addEventListener('DOMContentLoaded', function () {
    // Aguarda um pouco antes de mostrar o aviso de privacidade
    setTimeout(showPrivacyConfirm, 1000);
});