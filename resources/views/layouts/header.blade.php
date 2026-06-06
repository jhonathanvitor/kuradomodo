<header x-data="{ open: false }" class="fixed top-0 left-0 w-full bg-white shadow-sm z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-3">
        <!-- Logo -->
        <a href="/">
            <img src="{{ asset('img/home/LOGO-KURADOMODO.png') }}" alt="Logo" class="h-10">
        </a>

        <!-- Menu Desktop -->
        <nav class="hidden md:flex space-x-6 text-sm">
            <a href="/" data-section="instituto" class="hover:text-red-600">O INSTITUTO</a>
            <a href="/" data-section="equipe" class="hover:text-red-600">A EQUIPE</a>
            <a href="/" data-section="projetos" class="hover:text-red-600">PROJETOS</a>
            <a href="/" data-section="missao" class="hover:text-red-600">MISSÃO</a>
            <a href="/" data-section="areas" class="hover:text-red-600">ÁREAS DE ATUAÇÃO</a>
            <a href="/" data-section="noticias" class="hover:text-red-600">NOTÍCIAS</a>
            <a href="/" data-section="contato" class="hover:text-red-600">CONTATO</a>
        </nav>

        <!-- Botão Mobile -->
        <button @click="open = !open"
            class="md:hidden bg-red-600 text-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-red-700 transition-all duration-200">
            <span x-show="!open" class="text-2xl">+</span>
            <span x-show="open" class="text-2xl rotate-45">+</span>
        </button>
    </div>

    <!-- Menu Mobile -->
    <div x-show="open" x-transition @click.away="open = false"
        class="md:hidden absolute top-full left-0 w-full bg-white shadow-lg border-t border-gray-200 z-50">
        <nav class="flex flex-col items-center py-4 space-y-4 text-sm">
            <a href="/" data-section="instituto" class="hover:text-red-600" @click="open = false">O INSTITUTO</a>
            <a href="/" data-section="equipe" class="hover:text-red-600" @click="open = false">A EQUIPE</a>
            <a href="/" data-section="projetos" class="hover:text-red-600" @click="open = false">PROJETOS</a>
            <a href="/" data-section="missao" class="hover:text-red-600" @click="open = false">MISSÃO</a>
            <a href="/" data-section="areas" class="hover:text-red-600" @click="open = false">ÁREAS DE ATUAÇÃO</a>
            <a href="/" data-section="noticias" class="hover:text-red-600" @click="open = false">NOTÍCIAS</a>
            <a href="/" data-section="contato" class="hover:text-red-600" @click="open = false">CONTATO</a>
        </nav>
    </div>
</header>
