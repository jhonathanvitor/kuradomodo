@extends('layouts.admin.base')

@section('content')
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h1 class="mb-8 text-3xl font-bold text-gray-900">Criar Novo Usuário</h1>

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

        <form action="{{ route('admin.config.store') }}" method="POST">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nome</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        value="{{ old('name') }}" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        value="{{ old('email') }}" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Senha</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        required>
                </div>
                <div class="sm:col-span-2">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        required>
                </div>
                <div class="sm:col-span-2">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Tipo de Usuário</label>
                    <select name="role" id="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        <option value="user">Usuário</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
            </div>
            <div class="flex space-x-4">
                <button type="submit"
                    class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Criar Usuário
                </button>
                <a href="{{ route('admin.config.index') }}"
                    class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
