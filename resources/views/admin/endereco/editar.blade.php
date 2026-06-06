<!-- Modal para Editar Endereco -->
<div id="editarEnderecoModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-edit text-amber-600 mr-2"></i>
                    Editar Endereço
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="editarEnderecoModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Fechar modal</span>
                </button>
            </div>

            <div class="p-4 md:p-5">
                <form id="formEditarEndereco" method="POST"
                    action="{{ route('admin.endereco.update', $endereco->id ?? 0) }}">
                    @csrf
                    @method('PUT')

                    <!-- Endereço com Trix Editor -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Endereço <span class="text-red-500">*</span>
                        </label>
                        <input id="endereco_trix" name="endereco" type="hidden" value="{{ $endereco->endereco ?? '' }}">
                        <trix-editor input="endereco_trix"
                            class="trix-content border border-gray-300 rounded-lg min-h-[120px]"
                            placeholder="Digite o endereço completo...">
                        </trix-editor>
                    </div>

                    <!-- Telefone -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Telefone</label>
                        <input name="telefone" value="{{ $endereco->telefone ?? '' }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="text" name="email" value="{{ $endereco->email ?? '' }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>

                    <!-- Horário -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Horário de Funcionamento</label>
                        <input id="horario_atendimento_trix" name="horario_atendimento" type="hidden"
                            value="{{ $endereco->horario_atendimento ?? '' }}">
                        <trix-editor input="horario_atendimento_trix"
                            class="trix-content border border-gray-300 rounded-lg min-h-[120px]"
                            placeholder="Digite o horário de funcionamento...">
                        </trix-editor>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-amber-600 border border-transparent rounded-lg hover:bg-amber-700 focus:outline-none focus:ring-4 focus:ring-amber-300">
                            <i class="fas fa-save mr-2"></i>
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
