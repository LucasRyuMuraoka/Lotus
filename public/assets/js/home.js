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

    if (localStorage.getItem('privacyChoice') !== 'accepted') {

        // Primeiro pergunta se quer saber mais
        const wantInfo = confirm("Este site utiliza cookies para melhorar sua experiência.\n\n" +
            "Deseja saber mais sobre nossa Política de Privacidade antes de decidir?");

        if (wantInfo) {
            // Tenta abrir a política de privacidade
            try {
                window.open('./politica_privacidade', '_blank');
            } catch (error) {
                // Se não conseguir abrir em nova aba, redireciona na mesma
                window.location.href = './politica_privacidade';
                return; // Para não executar o resto do código
            }

            // Aguarda um pouco e pergunta novamente
            setTimeout(() => {
                const acceptCookies = confirm("Após conhecer nossa Política de Privacidade,\n" +
                    "você aceita o uso de cookies?");

                if (acceptCookies) {
                    localStorage.setItem('privacyChoice', 'accepted');
                    console.log('Cookies aceitos');
                } else {
                    localStorage.setItem('privacyChoice', 'declined');
                    console.log('Cookies recusados');
                }
            }, 2000); // Aumentei para 2 segundos
        } else {
            // Pergunta diretamente sobre aceitar
            const acceptCookies = confirm("Você aceita o uso de cookies?");

            if (acceptCookies) {
                localStorage.setItem('privacyChoice', 'accepted');
                console.log('Cookies aceitos');
            } else {
                localStorage.setItem('privacyChoice', 'declined');
                console.log('Cookies recusados');
            }
        }
    }

}

// Chamar a função
showPrivacyConfirm();
