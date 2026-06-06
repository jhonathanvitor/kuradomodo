// Adiciona um listener que só executa o código quando toda a página for carregada.
document.addEventListener('DOMContentLoaded', function() {

    // ========== MENU MOBILE ==========
    function setupMobileMenu() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (!mobileMenuButton || !mobileMenu) return; // Se os elementos não existirem, não faz nada.

        const closeMobileMenu = () => {
            document.body.classList.remove('mobile-menu-open');
            mobileMenu.classList.add('-translate-y-full');
            mobileMenu.classList.remove('translate-y-0');
        };

        mobileMenuButton.addEventListener('click', () => {
            document.body.classList.toggle('mobile-menu-open');
            mobileMenu.classList.toggle('translate-y-0');
            mobileMenu.classList.toggle('-translate-y-full');
        });

        mobileMenu.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        document.addEventListener('click', (event) => {
            const isClickInsideMenu = mobileMenu.contains(event.target);
            const isClickOnButton = mobileMenuButton.contains(event.target);
            if (!isClickInsideMenu && !isClickOnButton && !mobileMenu.classList.contains('-translate-y-full')) {
                closeMobileMenu();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !mobileMenu.classList.contains('-translate-y-full')) {
                closeMobileMenu();
            }
        });
    }

    // ========== FUNCIONALIDADE DO FAQ (ACCORDION) ==========
    function setupFaq() {
        const faqToggles = document.querySelectorAll('.faq-toggle');
        if (faqToggles.length === 0) return; // Se não houver FAQs, não faz nada.

        faqToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const answer = this.nextElementSibling; // A resposta é o próximo elemento
                const icon = this.querySelector('i.fas');
                const isExpanded = this.getAttribute('aria-expanded') === 'true';

                // Fecha todos os outros itens antes de abrir o novo
                faqToggles.forEach(otherToggle => {
                    if (otherToggle !== this) {
                        otherToggle.setAttribute('aria-expanded', 'false');
                        otherToggle.nextElementSibling.style.maxHeight = '0px';
                        otherToggle.querySelector('i.fas').style.transform = 'rotate(0deg)';
                    }
                });

                // Abre ou fecha o item clicado
                if (isExpanded) {
                    this.setAttribute('aria-expanded', 'false');
                    answer.style.maxHeight = '0px';
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    this.setAttribute('aria-expanded', 'true');
                    // A mágica acontece aqui: define o maxHeight para a altura real do conteúdo
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });
    }

    // ========== INICIALIZAÇÃO DE TODAS AS FUNÇÕES ==========
    setupMobileMenu();
    setupFaq();

    console.log('🚀 X7 Website JavaScript loaded successfully');

});
