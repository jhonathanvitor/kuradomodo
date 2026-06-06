<div>
    <label for="editar_nome" class="block mb-2 text-sm font-medium text-gray-900">
        Nome da Categoria <span class="text-red-500">*</span>
    </label>
    <input type="text" id="editar_nome" name="nome" value="{{ $formModel === 'editar' ? $categoria->nome : '' }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        placeholder="Digite o nome da categoria" required>
    <div id="erro_nome_editar" class="mt-2 text-sm text-red-600 hidden"></div>
</div>

<div class="flex items-center justify-end space-x-3 pt-4">
    <button type="submit"
        class=" {{ $formModel === 'editar' ? 'bg-amber-600 hover:bg-amber-700 text-white' : 'bg-[var(--accent-color)] hover:bg-green-700 text-black' }} focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        <i class="fas fa-save mr-2"></i>
        {{ $formModel === 'editar' ? 'Salvar Alterações' : 'Criar Categoria' }}
    </button>
</div>
