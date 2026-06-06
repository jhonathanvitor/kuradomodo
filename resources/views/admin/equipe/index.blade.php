@extends('layouts.admin.base')

@section('content')
    <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Gerenciamento da Equipe</h1>
            <a href="{{ route('admin.equipe.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Novo Membro
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($equipes as $membro)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                    <div class="flex flex-col items-center">
                        @if ($membro->foto)
    @php
        // 👈 Alterado para usar o método do Controller que resolve a URL correta do disco public_images
        $photoUrl = app('App\Http\Controllers\Admin\EquipeController')->getUrlFor($membro);
    @endphp
    <div class="relative">
        <img class="w-24 h-24 rounded-full mb-4 object-cover" src="{{ $photoUrl }}" alt="{{ e($membro->nome) }}">
        <span class="absolute bottom-4 right-0 bg-blue-600 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow">
            Nº {{ $membro->ordem }}
        </span>
    </div>
@else
    <div class="relative">
        <div class="w-24 h-24 rounded-full mb-4 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-500">Sem foto</span>
        </div>
        <span class="absolute bottom-4 right-0 bg-blue-600 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow">
            Nº {{ $membro->ordem }}
        </span>
    </div>
@endif
                        <h5 class="text-xl font-bold tracking-tight text-gray-900">{{ $membro->nome }}</h5>
                        <p class="text-gray-500">{{ $membro->cargo }}</p>
                        <p class="mt-2 text-sm text-gray-600 text-center">{{ Str::limit($membro->descricao, 100) }}</p>

                        <div class="mt-3">
                            <a href="{{ $membro->links }}" target="_blank"
                                class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $membro->links }}
                            </a>
                        </div>

                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('admin.equipe.edit', $membro->id) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Editar
                            </a>
                            <form action="{{ route('admin.equipe.destroy', $membro->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300"
                                    onclick="return confirm('Tem certeza que deseja deletar este membro?')">
                                    Deletar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
