@extends('layouts.admin.base')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">

            <!-- Page Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Categorias</h1>
                <button type="button" data-modal-target="criarCategoriaModal" data-modal-toggle="criarCategoriaModal"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fas fa-plus w-4 h-4 mr-2"></i>
                    Nova Categoria
                </button>
            </div>

            <!-- Mensagens de Sucesso/Erro -->
            @if (session('success'))
                <div id="alert-success"
                    class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 border border-green-200"
                    role="alert">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span class="sr-only">Sucesso</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-success" aria-label="Close">
                        <span class="sr-only">Fechar</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div id="alert-error"
                    class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 border border-red-200"
                    role="alert">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <span class="sr-only">Erro</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-error" aria-label="Close">
                        <span class="sr-only">Fechar</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            @if ($categorias->isEmpty())
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700 font-medium">
                                Nenhuma categoria encontrada.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($categorias as $categoria)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $categoria->nome }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <!-- Botão Editar -->
                                            <button type="button" data-modal-target="editarCategoriaModal"
                                                data-modal-toggle="editarCategoriaModal"
                                                onclick="carregarFormularioEdicaoCategoria({{ $categoria->id }})"
                                                class="inline-flex items-center px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 text-xs font-medium rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-1">
                                                <i class="fas fa-edit mr-1"></i>
                                                Editar
                                            </button>

                                            <!-- Botão Deletar -->
                                            <button type="button" data-modal-target="modal-confirmacao"
                                                data-modal-toggle="modal-confirmacao"
                                                onclick="prepararExclusaoCategoria({{ $categoria->id }}, '{{ $categoria->nome }}')"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-800 text-xs font-medium rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1">
                                                <i class="fas fa-trash mr-1"></i>
                                                Deletar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Incluir os modais específicos -->
    @include('admin.categoria.criar')
    @include('admin.categoria.editar')
@endsection
