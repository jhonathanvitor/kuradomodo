<aside>
    <nav>
        <div class="sidebar hidden md:flex min-h-screen w-[3.35rem] bg-[var(--primary-color)] overflow-hidden border-r hover:w-56 hover:bg-[var(--primary-color-hover)] hover:shadow-lg transition-all duration-300">
            <div class="flex h-screen flex-col justify-between pt-2 pb-6 w-full">
                <div>
                    <div class="px-4 py-3 border-b border-red-400/20">
                        <div class="w-8 h-8 bg-gradient-to-r from-sky-600 to-cyan-400 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">K.org</span>
                        </div>
                    </div>

                    <ul class="mt-6 space-y-2 tracking-wide">
                        <li class="min-w-max">
                            <a href="{{ route('admin.dashboard') }}" aria-label="dashboard"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z"
                                        class="fill-current text-cyan-400 dark:fill-slate-600"></path>
                                    <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z"
                                        class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                                    <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z"
                                        class="fill-current group-hover:text-sky-300"></path>
                                </svg>
                                <span class="group-hover:text-gray-700">Dashboard</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.imagens.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                    <rect x="2" y="4" width="20" height="16" rx="2" class="fill-current text-gray-300 group-hover:text-cyan-300" />
                                    <path d="M7 14l3-4 4 5 3-4 2 3v1H5v-1l2-1z" class="fill-current text-white group-hover:text-cyan-600" />
                                    <circle cx="9" cy="8" r="1.25" class="fill-current text-gray-400 group-hover:text-cyan-400" />
                                </svg>
                                <span class="group-hover:text-gray-700">Imagens</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.posts.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                                    <path class="fill-current text-white group-hover:text-cyan-600" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                                </svg>
                                <span class="group-hover:text-gray-700">Posts</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.categoria.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path class="fill-current text-white group-hover:text-cyan-600" fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                                    <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                                </svg>
                                <span class="group-hover:text-gray-700">Categorias</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.equipe.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <circle class="fill-current text-gray-300 group-hover:text-cyan-300" cx="4" cy="6" r="2"/>
                                    <circle class="fill-current text-white group-hover:text-cyan-600" cx="10" cy="6" r="3"/>
                                    <circle class="fill-current text-gray-300 group-hover:text-cyan-300" cx="16" cy="6" r="2"/>
                                    <path class="fill-current text-gray-400 group-hover:text-cyan-400" d="M2 15c0-1.657 3.134-3 7-3s7 1.343 7 3v1H2v-1z"/>
                                </svg>
                                <span class="group-hover:text-gray-700">Equipes</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.endereco.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path class="fill-current text-white group-hover:text-cyan-600" d="M10 2a8 8 0 00-8 8 v6a2 2 0 002 2h12a2 2 0 002-2v-6a8 8 0 00-8-8zm0 14a6 6 0 110-12 6 6 0 010 12z" />
                                    <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M10 4a6 6 0 00-6 6v6h12v-6a6 6 0 00-6-6z" />
                                    <path class="fill-current text-gray-400 group-hover:text-cyan-400" d="M10 8a2 2 0 100 4 2 2 0 000-4zm0 3a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                                <span class="group-hover:text-gray-700">Endereços</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="w-max -mb-3 space-y-2">
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('admin.config.index') }}"
                            class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:fill-cyan-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                            <span class="group-hover:text-gray-700">Configurações</span>
                        </a>
                    @endif
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)] hover:text-red-600 w-full text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                            </svg>
                            <span class="group-hover:text-gray-700">Sair</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</aside>




{{-- Sidebar Desktop (oculto no mobile) --}}
<aside class="hidden md:block">
    <nav>
        <div class="sidebar min-h-screen w-[3.35rem] bg-[var(--primary-color)] overflow-hidden border-r hover:w-56 hover:bg-[var(--primary-color-hover)] hover:shadow-lg transition-all duration-400">
            <div class="flex h-screen flex-col justify-between pt-2 pb-6">
                <div>
                    <div class="px-4 py-3 border-b border-red-400/20">
                        <div class="w-8 h-8 bg-gradient-to-r from-sky-600 to-cyan-400 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">K.org</span>
                        </div>
                    </div>

                                        <ul class="mt-6 space-y-2 tracking-wide">
                        <li class="min-w-max">
                            <a href="{{ route('admin.dashboard') }}" aria-label="dashboard"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z"
                                        class="fill-current text-cyan-400 dark:fill-slate-600"></path>
                                    <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z"
                                        class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                                    <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z"
                                        class="fill-current group-hover:text-sky-300"></path>
                                </svg>
                                <span class="group-hover:text-gray-700">Dashboard</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.imagens.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                    <rect x="2" y="4" width="20" height="16" rx="2" class="fill-current text-gray-300 group-hover:text-cyan-300" />
                                    <path d="M7 14l3-4 4 5 3-4 2 3v1H5v-1l2-1z" class="fill-current text-white group-hover:text-cyan-600" />
                                    <circle cx="9" cy="8" r="1.25" class="fill-current text-gray-400 group-hover:text-cyan-400" />
                                </svg>
                                <span class="group-hover:text-gray-700">Imagens</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.posts.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                                    <path class="fill-current text-white group-hover:text-cyan-600" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                                </svg>
                                <span class="group-hover:text-gray-700">Posts</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.categoria.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path class="fill-current text-white group-hover:text-cyan-600" fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                                    <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                                </svg>
                                <span class="group-hover:text-gray-700">Categorias</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.equipe.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <circle class="fill-current text-gray-300 group-hover:text-cyan-300" cx="4" cy="6" r="2"/>
                                    <circle class="fill-current text-white group-hover:text-cyan-600" cx="10" cy="6" r="3"/>
                                    <circle class="fill-current text-gray-300 group-hover:text-cyan-300" cx="16" cy="6" r="2"/>
                                    <path class="fill-current text-gray-400 group-hover:text-cyan-400" d="M2 15c0-1.657 3.134-3 7-3s7 1.343 7 3v1H2v-1z"/>
                                </svg>
                                <span class="group-hover:text-gray-700">Equipes</span>
                            </a>
                        </li>

                        <li class="min-w-max">
                            <a href="{{ route('admin.endereco.index') }}"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path class="fill-current text-white group-hover:text-cyan-600" d="M10 2a8 8 0 00-8 8 v6a2 2 0 002 2h12a2 2 0 002-2v-6a8 8 0 00-8-8zm0 14a6 6 0 110-12 6 6 0 010 12z" />
                                    <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M10 4a6 6 0 00-6 6v6h12v-6a6 6 0 00-6-6z" />
                                    <path class="fill-current text-gray-400 group-hover:text-cyan-400" d="M10 8a2 2 0 100 4 2 2 0 000-4zm0 3a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                                <span class="group-hover:text-gray-700">Endereços</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="w-max -mb-3 space-y-2">
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('admin.config.index') }}" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:fill-cyan-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                            <span class="group-hover:text-gray-700">Configurações</span>
                        </a>
                    @endif
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-[var(--accent-color)] hover:text-red-600 w-full text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                            </svg>
                            <span class="group-hover:text-gray-700">Sair</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</aside>

{{-- Bottom Navigation Mobile (visível apenas no mobile) --}}
<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-[var(--primary-color)] border-t border-red-400/20 z-50 safe-area-bottom">
    <div class="flex justify-around items-center h-16">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center justify-center flex-1 text-white hover:text-cyan-400 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-cyan-400' : '' }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z" class="fill-current"></path>
                <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z" class="fill-current"></path>
                <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z" class="fill-current"></path>
            </svg>
            <span class="text-xs mt-1">Dashboard</span>
        </a>
        
        <a href="{{ route('admin.imagens.index') }}" class="flex flex-col items-center justify-center flex-1 text-white hover:text-cyan-400 transition-colors {{ request()->routeIs('admin.imagens.*') ? 'text-cyan-400' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                <rect x="2" y="4" width="20" height="16" rx="2" class="fill-current" />
                <path d="M7 14l3-4 4 5 3-4 2 3v1H5v-1l2-1z" class="fill-current opacity-60" />
            </svg>
            <span class="text-xs mt-1">Imagens</span>
        </a>

        <a href="{{ route('admin.posts.index') }}" class="flex flex-col items-center justify-center flex-1 text-white hover:text-cyan-400 transition-colors {{ request()->routeIs('admin.posts.*') ? 'text-cyan-400' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path class="fill-current" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" />
                <path class="fill-current" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
            </svg>
            <span class="text-xs mt-1">Posts</span>
        </a>


        <a href="{{ route('admin.equipe.index') }}" class="flex flex-col items-center justify-center flex-1 text-white hover:text-cyan-400 transition-colors {{ request()->routeIs('admin.posts.*') ? 'text-cyan-400' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <circle class="fill-current text-gray-300 group-hover:text-cyan-300" cx="4" cy="6" r="2"/>
                                    <circle class="fill-current text-white group-hover:text-cyan-600" cx="10" cy="6" r="3"/>
                                    <circle class="fill-current text-gray-300 group-hover:text-cyan-300" cx="16" cy="6" r="2"/>
                                    <path class="fill-current text-gray-400 group-hover:text-cyan-400" d="M2 15c0-1.657 3.134-3 7-3s7 1.343 7 3v1H2v-1z"/>
                                </svg>
            <span class="text-xs mt-1">Equipe</span>
        </a>
        
        {{-- Botão Menu (abre modal com mais opções) --}}
        <button id="mobile-more-menu" class="flex flex-col items-center justify-center flex-1 text-white hover:text-cyan-400 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
            </svg>
            <span class="text-xs mt-1">Mais</span>
        </button>
    </div>
</nav>

{{-- Modal Menu "Mais" para mobile --}}
<div id="more-menu-modal" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="absolute bottom-0 left-0 right-0 bg-white rounded-t-2xl p-6 transform translate-y-full transition-transform duration-300" id="more-menu-content">
        <div class="w-12 h-1 bg-gray-300 rounded-full mx-auto mb-6"></div>
        
        <div class="space-y-2">
            <a href="{{ route('admin.categoria.index') }}" class="flex items-center space-x-4 p-4 rounded-lg hover:bg-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                    <path class="fill-current" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" />
                </svg>
                <span class="text-gray-800 font-medium">Categorias</span>
            </a>

            <a href="{{ route('admin.endereco.index') }}" class="flex items-center space-x-4 p-4 rounded-lg hover:bg-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path class="fill-current text-white group-hover:text-cyan-600" d="M10 2a8 8 0 00-8 8 v6a2 2 0 002 2h12a2 2 0 002-2v-6a8 8 0 00-8-8zm0 14a6 6 0 110-12 6 6 0 010 12z" />
                                    <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M10 4a6 6 0 00-6 6v6h12v-6a6 6 0 00-6-6z" />
                                    <path class="fill-current text-gray-400 group-hover:text-cyan-400" d="M10 8a2 2 0 100 4 2 2 0 000-4zm0 3a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                <span class="text-gray-800 font-medium">Endereços</span>
            </a>
            
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.config.index') }}" class="flex items-center space-x-4 p-4 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-800 font-medium">Configurações</span>
                </a>
            @endif
            
            <form method="POST" action="{{ route('admin.logout') }}" class="inline w-full">
                @csrf
                <button type="submit" class="flex items-center space-x-4 p-4 rounded-lg hover:bg-red-50 transition-colors w-full text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-red-600 font-medium">Sair</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const moreMenuButton = document.getElementById('mobile-more-menu');
    const moreMenuModal = document.getElementById('more-menu-modal');
    const moreMenuContent = document.getElementById('more-menu-content');
    
    function openMoreMenu() {
        moreMenuModal.classList.remove('hidden');
        setTimeout(() => {
            moreMenuContent.style.transform = 'translateY(0)';
        }, 10);
    }
    
    function closeMoreMenu() {
        moreMenuContent.style.transform = 'translateY(100%)';
        setTimeout(() => {
            moreMenuModal.classList.add('hidden');
        }, 300);
    }
    
    moreMenuButton.addEventListener('click', openMoreMenu);
    
    moreMenuModal.addEventListener('click', function(e) {
        if (e.target === moreMenuModal) {
            closeMoreMenu();
        }
    });
});
</script>

{{-- Adicione padding-bottom ao conteúdo para não ficar sob a bottom nav --}}
<style>
    @media (max-width: 768px) {
        .admin-content {
            padding-bottom: 5rem; /* Espaço para a bottom navigation */
        }
    }
</style>