@extends('layouts.admin.base')

@section('title', 'Criar Post')

@section('content')
    <div class="p-8">
        <div class="p-6 bg-gray-50 min-h-screen">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-light text-gray-800 mb-1">Criar Novo Post</h1>
                    <p class="text-gray-500 text-sm">Adicione um novo post</p>
                </div>
                <a href="{{ route('admin.posts.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-600 font-medium rounded-lg border border-gray-200 transition-all duration-200 shadow-sm hover:shadow">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Voltar
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                @include('admin.post.form')

            </div>
        </div>
    </div>
@endsection
