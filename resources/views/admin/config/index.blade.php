@extends('layouts.admin.base')

@section('content')
    <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Gerenciamento de Usuários</h1>
            <a href="{{ route('admin.config.create') }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Novo Usuário
            </a>
        </div>

        @if (session('success'))
            <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#alert-error" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="space-y-4">
            @foreach ($users as $user)
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                            <img class="w-16 h-16 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF"
                                alt="{{ $user->name }}'s avatar">
                            <div>
                                <h5 class="text-xl font-bold tracking-tight text-gray-900">
                                    {{ $user->name }}</h5>
                                <p class="font-normal text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $user->role === 'admin' ? 'Administrador' : 'Usuário' }}
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-shrink-0 space-x-2">
                            <button type="button" data-modal-target="edit-user-modal-{{ $user->id }}"
                                data-modal-toggle="edit-user-modal-{{ $user->id }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-black bg-cyan-200 rounded-lg hover:bg-cyan-300 focus:ring-4 focus:outline-none focus:ring-primary-300">
                                Alterar Dados
                            </button>
                            <button type="button" data-modal-target="change-password-modal-{{ $user->id }}"
                                data-modal-toggle="change-password-modal-{{ $user->id }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-[var(--accent-color)] border border-gray-300 rounded-lg hover:bg-[var(--accent-color-hover)] focus:ring-4 focus:outline-none focus:ring-gray-200">
                                Alterar Senha
                            </button>
                            @if ($user->id !== auth()->id())
                                <button type="button" data-modal-target="delete-user-modal-{{ $user->id }}"
                                    data-modal-toggle="delete-user-modal-{{ $user->id }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300">
                                    Deletar
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal para editar dados do usuário -->
                <div id="edit-user-modal-{{ $user->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                        <div class="relative p-4 bg-white rounded-lg shadow">
                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                <h3 class="text-lg font-semibold text-gray-900">Alterar Dados do Usuário</h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                    data-modal-toggle="edit-user-modal-{{ $user->id }}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Fechar modal</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.config.updateDetails', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="name-{{ $user->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-900">Nome</label>
                                        <input type="text" name="name" id="name-{{ $user->id }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="email-{{ $user->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                        <input type="email" name="email" id="email-{{ $user->id }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="role-{{ $user->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-900">Tipo de Usuário</label>
                                        <select name="role" id="role-{{ $user->id }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuário</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="w-full text-black bg-[var(--accent-color)] hover:bg-[var(--accent-color-hover)] focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Salvar Alterações
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para alterar senha -->
                <div id="change-password-modal-{{ $user->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                        <div class="relative p-4 bg-white rounded-lg shadow">
                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                <h3 class="text-lg font-semibold text-gray-900">Alterar Senha de
                                    {{ $user->name }}</h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                    data-modal-toggle="change-password-modal-{{ $user->id }}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Fechar modal</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.config.updatePassword', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="grid gap-4 mb-4">
                                    <div>
                                        <label for="password-{{ $user->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-900">Nova
                                            Senha</label>
                                        <input type="password" name="password" id="password-{{ $user->id }}"
                                            placeholder="••••••••"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            required>
                                    </div>
                                    <div>
                                        <label for="password_confirmation-{{ $user->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-900">Confirmar
                                            Nova Senha</label>
                                        <input type="password" name="password_confirmation"
                                            id="password_confirmation-{{ $user->id }}" placeholder="••••••••"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            required>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="w-full text-black bg-[var(--accent-color)] hover:bg-[var(--accent-color-hover)] focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Atualizar Senha
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para deletar usuário -->
                @if ($user->id !== auth()->id())
                    <div id="delete-user-modal-{{ $user->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                            <div class="relative p-4 bg-white rounded-lg shadow">
                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                    <h3 class="text-lg font-semibold text-gray-900">Confirmar Exclusão</h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                        data-modal-toggle="delete-user-modal-{{ $user->id }}">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Fechar modal</span>
                                    </button>
                                </div>
                                <div class="text-center">
                                    <svg class="mx-auto mb-4 w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Tem certeza que deseja deletar o usuário <strong>{{ $user->name }}</strong>?</h3>
                                    <form action="{{ route('admin.config.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            Sim, deletar usuário
                                        </button>
                                    </form>
                                    <button data-modal-toggle="delete-user-modal-{{ $user->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
