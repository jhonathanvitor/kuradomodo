<!-- Modal de Confirmação Reutilizável -->
<div id="modal-confirmacao" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <!-- Botão fechar -->
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                data-modal-hide="modal-confirmacao">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Fechar modal</span>
            </button>

            <!-- Conteúdo do modal -->
            <div class="p-4 md:p-5 text-center">
                <!-- Ícone de aviso -->
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <!-- Título -->
                <h3 id="confirmacao-titulo" class="mb-2 text-lg font-semibold text-gray-900">
                    Confirmar Exclusão
                </h3>

                <!-- Mensagem -->
                <p id="confirmacao-mensagem" class="mb-2 text-sm font-normal text-gray-500">
                    Tem certeza que deseja excluir este item?
                </p>

                <!-- Nome do item -->
                <p id="confirmacao-nome-item" class="mb-4 text-sm text-gray-700">
                    <!-- Nome será inserido aqui via JavaScript -->
                </p>

                <!-- Aviso -->
                <p class="mb-5 text-xs text-red-600">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    Esta ação não pode ser desfeita.
                </p>

                <!-- Formulário de exclusão -->
                <form id="confirmacao-form" method="POST" class="inline">
                    @csrf
                    @method('DELETE')

                    <!-- Botão confirmar -->
                    <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        <i class="fas fa-trash mr-2"></i>
                        Sim, excluir
                    </button>

                    <!-- Botão cancelar -->
                    <button data-modal-hide="modal-confirmacao" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        Cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
