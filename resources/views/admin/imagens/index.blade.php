@extends('layouts.admin.base')
@section('title', 'Biblioteca de Imagens')

@section('content')
    <div class="p-8">
        <div class="p-6 bg-gray-50 min-h-screen">
            <h1 class="text-3xl font-light text-gray-800 mb-6">Biblioteca de Mídia</h1>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-200 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Adicionar Nova Imagem</h2>
                <form action="{{ route('admin.imagens.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Arquivo</label>
                            <div class="mt-1 flex items-center gap-3">
                                <label for="imagem"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <i class="fas fa-cloud-upload-alt mr-2 text-gray-600"></i>
                                    <span class="text-sm text-gray-700">Selecionar arquivo</span>
                                </label>

                                <span id="imagem-filename" class="text-sm text-gray-500">Nenhum arquivo selecionado</span>

                                <img id="imagem-preview" alt="Pré-visualização" class="hidden w-24 h-24 object-cover rounded border ml-2 bg-gray-100" />
                            </div>

                            <input type="file" name="imagem" id="imagem" required class="sr-only">

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const input = document.getElementById('imagem');
                                    const filenameSpan = document.getElementById('imagem-filename');
                                    const preview = document.getElementById('imagem-preview');

                                    input.addEventListener('change', function () {
                                        const file = this.files[0];
                                        filenameSpan.textContent = file ? file.name : 'Nenhum arquivo selecionado';

                                        if (file && file.type.startsWith('image/')) {
                                            // liberar a URL quando não for mais necessária poderia ser feito ao enviar ou remover a imagem
                                            preview.src = URL.createObjectURL(file);
                                            preview.classList.remove('hidden');
                                        } else {
                                            preview.src = '';
                                            preview.classList.add('hidden');
                                        }
                                    });
                                });
                            </script>
                        </div>
                        <div>
                            <label for="alt_text" class="block text-sm font-medium text-gray-700">Texto Alternativo
                                (Alt)</label>
                            <input type="text" name="alt_text" id="alt_text"
                                placeholder="Descrição da imagem (para SEO)"
                                class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg">
                            <i class="fas fa-upload mr-2"></i> Enviar Imagem
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Imagens Enviadas</h2>
                @if ($imagens->isEmpty())
                    <p class="text-gray-500 text-center">Nenhuma imagem encontrada.</p>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach ($imagens as $imagem)
                            <div class="relative group border rounded-lg overflow-hidden shadow-sm">
                                <img src="{{ Storage::disk('public_images')->url($imagem->path) }}" alt="{{ $imagem->alt_text }}"
                                    class="w-full h-32 object-cover bg-gray-100">
                                <div class="p-2 text-xs">
                                    <p class="font-medium truncate" title="{{ $imagem->filename }}">{{ $imagem->filename }}
                                    </p>
                                </div>
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <form action="{{ route('admin.imagens.destroy', $imagem->id) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white text-xl"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">{{ $imagens->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
