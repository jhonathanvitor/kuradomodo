@extends('layouts.admin.base')

@section('content')
<div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
    <h1 class="mb-8 text-3xl font-bold text-gray-900">Editar Membro</h1>

    @if ($errors->any())
        <div class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
            <div class="ms-3 text-sm font-medium">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.equipe.update', $equipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="nome" class="block mb-2 text-sm font-medium text-gray-900">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $equipe->nome) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    required>
            </div>
            <div class="sm:col-span-2">
                <label for="cargo" class="block mb-2 text-sm font-medium text-gray-900">Cargo</label>
                <input type="text" name="cargo" id="cargo" value="{{ old('cargo', $equipe->cargo) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
            </div>
            <div class="sm:col-span-2">
                <label for="foto" class="block mb-2 text-sm font-medium text-gray-900">Foto</label>
                <input type="file" name="foto" id="foto"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                @if ($equipe->foto)
                    <div class="mt-2">
                        <img src="{{ app('App\Http\Controllers\Admin\EquipeController')->getUrlFor($equipe) }}"
                            alt="{{ $equipe->nome }}" class="w-24 h-24 rounded-full object-cover">
                        <p class="text-sm text-gray-500 mt-1">Foto atual</p>
                    </div>
                @endif
            </div>
            <div class="sm:col-span-2">
                <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900">Descrição</label>
                <textarea name="descricao" id="descricao" rows="4"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">{{ old('descricao', $equipe->descricao) }}</textarea>
            </div>
            <div class="sm:col-span-2">
                <label for="links" class="block mb-2 text-sm font-medium text-gray-900">Links (separados por vírgula)</label>
                <input type="text" name="links" id="links" value="{{ old('links', $equipe->links ? implode(', ', $equipe->links) : '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    placeholder="Ex: https://linkedin.com/in/usuario, https://github.com/usuario">
            </div>
            <div class="sm:col-span-2">
                <label for="ordem" class="block mb-2 text-sm font-medium text-gray-900">Ordem de Exibição</label>
                <input type="number" name="ordem" id="ordem" value="{{ old('ordem', $equipe->ordem) }}" min="0"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
            </div>
        </div>
        <div class="flex space-x-4">
            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Atualizar Membro
            </button>
            <a href="{{ route('admin.equipe.index') }}"
                class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
