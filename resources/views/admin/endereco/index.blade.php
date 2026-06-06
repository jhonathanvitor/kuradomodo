@extends('layouts.admin.base')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">

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
                        onclick="this.parentElement.style.display='none'" aria-label="Close">
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
                        onclick="this.parentElement.style.display='none'" aria-label="Close">
                        <span class="sr-only">Fechar</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Botão Criar (quando já existem endereços) -->
            @if(count($enderecos) > 0)
                <div class="mb-6 flex justify-end">
                    <button type="button"
                        data-modal-target="criarEnderecoModal"
                        data-modal-toggle="criarEnderecoModal"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-150">
                        <i class="fas fa-plus mr-2"></i>
                        Novo Endereço
                    </button>
                </div>
            @endif

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
                @forelse ($enderecos as $endereco)
                    <div
                        class="bg-white shadow-sm rounded-lg border border-gray-200 hover:shadow-md transition-all duration-200 hover:border-gray-300">
                        <!-- Header do Card -->
                        <div
                            class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 rounded-t-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Endereço
                                        </h3>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <!-- Botão Editar -->
                                    <button type="button"
                                        data-modal-target="editarEnderecoModal"
                                        data-modal-toggle="editarEnderecoModal"
                                        onclick="carregarFormularioEdicaoEndereco({{ $endereco->id }})"
                                        class="inline-flex items-center px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 text-xs font-medium rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-1">
                                        <i class="fas fa-edit mr-1"></i>
                                        Editar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Conteúdo do Card -->
                        <div class="px-6 py-6 space-y-6">
                            <!-- Endereço -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-home text-green-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Endereço</p>
                                    <div class="text-sm text-gray-900 leading-relaxed">
                                        {!! $endereco->endereco !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Telefone -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-phone text-blue-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Telefone</p>
                                    <p class="text-sm text-gray-900">
                                        <div class="break-all">
                                            {{ $endereco->telefone }}
                                        </div>
                                    </p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-envelope text-purple-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Email</p>
                                    <p class="text-sm text-gray-900">
                                        <div class="break-all">
                                            {{ $endereco->email }}
                                        </div>
                                    </p>
                                </div>
                            </div>

                            <!-- Horário de Atendimento -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-clock text-orange-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Horário de Atendimento</p>
                                    <div class="text-sm text-gray-900 leading-relaxed">
                                        {!! $endereco->horario_atendimento !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Card de estado vazio -->
                    <div class="col-span-full">
                        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-12 text-center">
                            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-map-marker-alt text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum endereço encontrado</h3>
                            <p class="text-gray-500 mb-6">Comece criando seu primeiro endereço.</p>
                            <button type="button" data-modal-target="criarEnderecoModal"
                                data-modal-toggle="criarEnderecoModal"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-150">
                                <i class="fas fa-plus mr-2"></i>
                                Criar Primeiro Endereço
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modais (FORA DO LOOP) -->
    @include('admin.endereco.criar')

    @if(isset($enderecos) && count($enderecos) > 0)
        @include('admin.endereco.editar', ['endereco' => $enderecos[0]])
    @endif

    <!-- Script JavaScript -->
    <script>
        function carregarFormularioEdicaoEndereco(enderecoId) {
            // Buscar dados do endereço via AJAX
            fetch(`/admin/endereco/${enderecoId}/edit`)
                .then(response => response.text())
                .then(html => {
                    // Parse HTML retornado
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const modalContent = doc.querySelector('#editarEnderecoModal');

                    // Substituir conteúdo do modal existente
                    const currentModal = document.querySelector('#editarEnderecoModal');
                    if (currentModal && modalContent) {
                        currentModal.innerHTML = modalContent.innerHTML;
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar formulário:', error);
                    alert('Erro ao carregar o formulário de edição. Tente novamente.');
                });
        }
    </script>
@endsection
