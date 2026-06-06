// ========================================
// ADMIN.JS - Scripts reutilizáveis
// ========================================

document.addEventListener("DOMContentLoaded", function () {
    // Configurações globais do Trix Editor
    document.addEventListener("trix-initialize", function (event) {
        const editor = event.target;
        const toolbar = editor.toolbarElement;

        // Configurar altura mínima
        editor.style.minHeight = "120px";

        // Remover botões desnecessários (opcional)
        const buttonsToHide = [
            '[data-trix-action="attachFiles"]', // Anexar arquivos
            '[data-trix-action="increaseNestingLevel"]', // Aumentar indentação
            '[data-trix-action="decreaseNestingLevel"]', // Diminuir indentação
        ];

        buttonsToHide.forEach((selector) => {
            const button = toolbar.querySelector(selector);
            if (button) {
                button.style.display = "none";
            }
        });
    });

    // ####################################################################
    // O BLOCO QUE CAUSAVA O ERRO (LINHAS 31-50) FOI REMOVIDO DAQUI.
    // ####################################################################

    // Validação do formulário de Endereço (somente se ele existir na página)
    // Esta é a maneira correta, pois verifica se o elemento existe
    // antes de adicionar um 'event listener'.
    const formEndereco = document.getElementById("formEditarEndereco");

    if (formEndereco) {
        // <-- Esta verificação (if) previne o erro!
        formEndereco.addEventListener("submit", function (e) {
            const enderecoEditor = document.querySelector(
                'trix-editor[input="endereco_trix"]'
            );
            const horarioEditor = document.querySelector(
                'trix-editor[input="horario_atendimento_trix"]'
            );

            // Verificação de segurança: garantir que os editores Trix existem
            if (!enderecoEditor || !horarioEditor) {
                console.warn(
                    "Editores Trix não encontrados no formulário de endereço."
                );
                // Previne o envio se os editores não forem encontrados
                e.preventDefault();
                return;
            }

            const enderecoContent = enderecoEditor.value.trim();
            const horarioContent = horarioEditor.value.trim();

            // Validar endereço
            if (!enderecoContent || enderecoContent === "<div><br></div>") {
                e.preventDefault();
                alert("Por favor, preencha o campo endereço.");
                enderecoEditor.focus();
                return false;
            }

            // Validar horário
            if (!horarioContent || horarioContent === "<div><br></div>") {
                e.preventDefault();
                alert("Por favor, preencha o campo horário de funcionamento.");
                horarioEditor.focus();
                return false;
            }
        });
    }
}); // Fim do 'DOMContentLoaded'

// Configuração adicional para melhorar a experiência
document.addEventListener("trix-change", function (event) {
    const editor = event.target;

    // Auto-salvar (opcional)
    // localStorage.setItem('endereco_draft_' + editor.inputElement.id, editor.value);
});

/**
 * Carrega formulário de edição via AJAX
 * @param {number} id - ID do item
 * @param {string} url - URL para buscar o formulário'
 * @param {string} contentId - ID do elemento onde inserir o conteúdo
 * @param {string} loadingColor - Cor do spinner (padrão: blue)
 */
function carregarFormularioEdicao(id, url, contentId, loadingColor = "blue") {
    const content = document.getElementById(contentId);

    if (!content) {
        console.error(`Elemento com ID '${contentId}' não encontrado`);
        return;
    }

    // Mostrar loading
    content.innerHTML = `
        <div class="flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-${loadingColor}-600"></div>
        </div>
    `;

    // Fazer requisição AJAX
    fetch(url.replace(":id", id))
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then((html) => {
            content.innerHTML = html;
        })
        .catch((error) => {
            console.error("Erro:", error);
            content.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl mb-2"></i>
                    <p class="text-red-600">Erro ao carregar formulário</p>
                    <p class="text-sm text-gray-500 mt-1">Tente novamente</p>
                </div>
            `;
        });
}

/**
 * Prepara modal de confirmação para exclusão
 * @param {number} id - ID do item
 * @param {string} nome - Nome do item
 * @param {string} action - URL de ação para o formulário
 * @param {string} tipo - Tipo do item (categoria, produto, etc.)
 */
function prepararModalConfirmacao(id, nome, action, tipo = "item") {
    // Atualizar texto do modal
    const titulo = document.getElementById("confirmacao-titulo");
    const mensagem = document.getElementById("confirmacao-mensagem");
    const nomeItem = document.getElementById("confirmacao-nome-item");
    const form = document.getElementById("confirmacao-form");

    if (titulo) titulo.textContent = `Excluir ${tipo}`;
    if (mensagem)
        mensagem.textContent = `Tem certeza que deseja excluir ${
            tipo === "categoria" ? "esta categoria" : "este " + tipo
        }?`;
    if (nomeItem) nomeItem.innerHTML = `<strong>"${nome}"</strong>`;
    if (form) form.action = action.replace(":id", id);
}

/**
 * Auto-hide alerts após um tempo determinado
 * @param {number} tempo - Tempo em milissegundos (padrão: 5000)
 */
function autoHideAlerts(tempo = 5000) {
    setTimeout(() => {
        const alerts = document.querySelectorAll('[id^="alert-"]');
        alerts.forEach((alert) => {
            if (alert) {
                alert.style.transition = "opacity 0.5s ease-out";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        });
    }, tempo);
}

/**
 * Inicializa scripts comuns da área admin
 */
function initAdmin() {
    // Auto-hide alerts
    autoHideAlerts();

    // Outros scripts de inicialização podem ir aqui
    console.log("Admin scripts carregados");
}

// Executar quando o DOM estiver carregado
document.addEventListener("DOMContentLoaded", function () {
    initAdmin();
});

// ========================================
// FUNÇÕES ESPECÍFICAS PARA CATEGORIAS
// ========================================

/**
 * Carrega formulário de edição de categoria
 * @param {number} categoriaId - ID da categoria
 */
function carregarFormularioEdicaoCategoria(categoriaId) {
    carregarFormularioEdicao(
        categoriaId,
        "/admin/categoria/:id/edit",
        "editarCategoriaContent",
        "blue"
    );
}

/**
 * Carrega formulário de edição de endereço
 * @param {number} enderecoId - ID do endereço
 */
function carregarFormularioEdicaoEndereco(enderecoId) {
    carregarFormularioEdicao(
        enderecoId,
        "{{ route('admin.endereco.edit', ':id') }}", // Rota nomeada
        "editarEnderecoContent",
        "blue"
    );
}

/**
 * Prepara modal de confirmação para exclusão de categoria
 * @param {number} categoriaId - ID da categoria
 * @param {string} categoriaNome - Nome da categoria
 */
function prepararExclusaoCategoria(categoriaId, categoriaNome) {
    prepararModalConfirmacao(
        categoriaId,
        categoriaNome,
        "/admin/categoria/:id",
        "categoria"
    );
}

/**
 * Carrega formulário de edição de case
 * @param {number} caseId - ID do case
 */
function carregarFormularioEdicaoCase(caseId) {
    carregarFormularioEdicao(
        caseId,
        "/admin/cases/" + caseId + "/edit-ajax",
        "editarCaseContent",
        "blue"
    );
}

/**
 * Prepara modal de confirmação para exclusão de case
 * @param {number} caseId - ID do case
 * @param {string} caseTitle - Título do case
 */
function prepararExclusaoCase(caseId, caseTitle) {
    prepararModalConfirmacao(
        caseId,
        caseTitle,
        "/admin/cases/" + caseId,
        "case"
    );
}
