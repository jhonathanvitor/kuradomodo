<form id="categoriaForm" method="POST" action="{{ route('admin.categoria.update', $categoria->id) }}">
    @csrf
    @method('PUT')
    <div>
        @include('admin.categoria.form', [
            'formModel' => 'editar',
            'modalId' => 'editarCategoriaModal',
            'submitText' => 'Salvar Alterações',
            'categoria' => $categoria,
        ])
    </div>
</form>
