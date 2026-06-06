@extends('layouts.app')

@section('title', 'Instituto Kurâdomôdo')

@section('content')
    <section x-data="{ openModalEquipe: null }">
        <div class="relative min-h-screen flex flex-col justify-center items-center text-center bg-cover bg-center bg-no-repeat px-4"
            style="background-image: url('{{ asset('img/home/BG_SITE_KURADOMODO.png') }}');">

            <div id="instituto"
                class="hidden absolute md:top-[15%] md:right-[15%] bg-[#c63c3c] text-white rounded-xl p-6 md:p-8 w-[90%] max-w-xl shadow-xl text-left md:text-left text-sm md:text-base
           md:left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 md:translate-x-0 md:translate-y-0 left-[95%]">
                <h3 class="text-lg md:text-xl font-bold mb-3">O INSTITUTO</h3>
                <p class="leading-relaxed">
                    Nos identificamos como uma organização que busca, destacando aspectos e expressões culturais diversas,
                    (re)construir e cuidar das nossas relações dentro da sociedade, humanas e da natureza.
                    Com 17 anos de existência, o Instituto Kurâdomôdo traz, em sua nova fase de existência,
                    outros formatos de parcerias com novos olhares sensíveis às maneiras de existir e coexistir em nossa
                    sociedade.
                    Dessa forma, visamos a criação de um mundo sustentável por meio da união de profissionais de áreas
                    interdisciplinares ligadas à arte e ao meio ambiente.
                </p>
            </div>

            <div id="equipe"
                class="hidden absolute md:top-[15%] md:right-[10%] bg-[#c63c3c] text-white rounded-xl p-6 md:p-8 w-[90%] max-w-4xl shadow-xl text-left md:text-left text-sm md:text-base
           md:left-[45%] top-[217%] transform -translate-x-1/2 -translate-y-1/2 md:translate-x-0 md:translate-y-0 left-[95%]">

                <h3 class="text-lg md:text-xl font-bold mb-4">EQUIPE</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs md:text-sm">
                    @foreach ($equipes as $equipe)
                        <div @click="openModalEquipe = {{ $loop->index }}"
                            class="flex flex-col items-center text-center cursor-pointer hover:opacity-80 transition-opacity">
                            <img src="{{ asset('img/' . $equipe->foto) }}" alt="{{ $equipe->nome }}"
                                class="w-20 h-20 object-cover rounded-full mb-2 border-2 border-white shadow-md">
                            <h4 class="font-semibold">{{ $equipe->nome }}</h4>
                            <p class="text-sm">{{ $equipe->cargo }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="projetos"
                class="hidden absolute md:top-[15%] md:right-[15%] bg-[#c63c3c] text-white rounded-xl p-6 md:p-8 w-[90%] max-w-lg shadow-xl text-left md:text-left text-sm md:text-base
           md:left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 md:translate-x-0 md:translate-y-0 left-[95%]">
                <h3 class="text-lg md:text-xl font-bold mb-3">PROJETOS INSTITUCIONAIS</h3>
                <div>
                    @if ($projetos->count() > 0)
                        <ul class="list-disc pl-5 space-y-2">
                            @foreach ($projetos as $projeto)
                                <li>
                                    <a href="{{ route('projeto.show', $projeto->slug) }}" class="hover:underline"
                                        target="_blank">
                                        {{ $projeto->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-6 text-white pagination-links">
                            {!! $projetos->links() !!}
                        </div>
                    @else
                        @if ($request->has('search_noticias'))
                            <p>Nenhuma notícia encontrada para: "{{ $request->input('search_noticias') }}"</p>
                        @else
                            <p>Nenhuma notícia encontrada no momento.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div id="missao"
            class="hidden absolute md:top-[15%] md:right-[15%] bg-[#c63c3c] text-white rounded-xl p-6 md:p-8 w-[90%] max-w-xl shadow-xl text-left md:text-left text-sm md:text-base
           md:left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 md:translate-x-0 md:translate-y-0 left-[95%]">
            <h3 class="text-lg md:text-xl font-bold mb-3">MISSÃO</h3>
            <p class="leading-relaxed">
                Promover o dálogo multidiciplinar entre as diversas expressões culturais, fortalecer as manifestações
                das
                comunidades tradicionais e agricultores familiares e o meio ambiente, enfatizando a criação e a
                manutenção
                de modo de vida sustentável, conforme os acordos internacionais e politicas nacionais.
            </p>
        </div>

        <div id="areas"
            class="hidden absolute md:top-[15%] md:right-[15%] bg-[#c63c3c] text-white rounded-xl p-6 md:p-8 w-[90%] max-w-xl shadow-xl text-left md:text-left text-sm md:text-base
           md:left-1/2 top-[80%] transform -translate-x-1/2 -translate-y-1/2 md:translate-x-0 md:translate-y-0 left-[95%]">
            <h3 class="text-lg md:text-xl font-bold mb-3">ÁREAS DE ATUAÇÃO</h3>
            <p class="leading-relaxed">
                Articulação de ações e projetos já existentes nas comunidades, desenvolvendo em rede ações culturais
                continuadas nos mais diversos campos e linguagens artístico-culturais, ou em áreas temáticas tais como:
            </p>
            <ul class="list-disc pl-5 space-y-1 mt-2">
                <li>1. Cultura e Meio Ambiente</li>
                <li>2. Culturas Populares e Tradição</li>
                <li>3. Cultura LGBTQIA</li>
                <li>4. Culturas Negras</li>
                <li>5. Povos e Comunidades Tradicionais de matriz africana</li>
                <li>6. Culturas Indígenas</li>
                <li>7. Territórios e Memória</li>
                <li>8. Patrimônio Cultural</li>
                <li>9. Cultura e Infância</li>
                <li>10. Bibliotecas Comunitárias</li>
                <li>11. Cultura e acessibilidade</li>
                <li>12. Cultura e Educação</li>
                <li>13. Cultura Digital</li>
                <li>14. Cultura e Comunicação</li>
                <li>15. Cultura de Gênero</li>
                <li>16. Cultura e Direitos Humanos</li>
                <li>17. Cultura e grupos e comunidades étnicas</li>
            </ul>
        </div>

        <div id="noticias"
            class="hidden absolute md:top-[10%] md:right-[15%] bg-[#c63c3c] text-white rounded-xl p-6 md:p-8 w-[90%] max-w-xl shadow-xl text-left md:text-left text-sm md:text-base
                   md:left-1/2 top-[100%] transform -translate-x-1/2 -translate-y-1/2 md:translate-x-0 md:translate-y-0 left-[95%]">

            <h3 class="text-lg md:text-xl font-bold mb-4">NOTÍCIAS</h3>

            <form action="{{ route('index') }}" method="GET" class="mb-4">
                <div class="relative">
                    <input type="text" name="search_noticias" placeholder="Buscar notícia..."
                        value="{{ $request->input('search_noticias', '') }}"
                        class="w-full p-2 rounded bg-white text-gray-800 placeholder-gray-500 border border-transparent focus:outline-none focus:ring-2 focus:ring-white">
                    <button type="submit" class="absolute right-0 top-0 h-full px-3 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <div>
                @if ($posts->count() > 0)
                    <ul class="list-disc pl-5 space-y-2">
                        @foreach ($posts as $post)
                            <li>
                                <a href="{{ route('post.show', $post->slug) }}" class="hover:underline" target="_blank">
                                    {{ $post->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-6 text-white pagination-links">
                        {!! $posts->links() !!}
                    </div>
                @else
                    @if ($request->has('search_noticias'))
                        <p>Nenhuma notícia encontrada para: "{{ $request->input('search_noticias') }}"</p>
                    @else
                        <p>Nenhuma notícia encontrada no momento.</p>
                    @endif
                @endif
            </div>
        </div>

        <div id="contato"
            class="hidden absolute md:top-[15%] md:right-[15%] bg-[#fff] text-dark rounded-xl p-6 md:p-8 w-[90%] max-w-xl shadow-xl text-left md:text-left text-sm md:text-base
           md:left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 md:translate-x-0 md:translate-y-0 left-[95%]">
            <h3 class="text-lg md:text-xl font-bold mb-3">FALE CONOSCO</h3>
            @if ($endereco)
                <div>
                    <div class="space-y-2">
                        <p class="mb-2 flex items-start">
                            <!-- ícone de localização -->
                            <span class="w-5 h-5 mr-2 text-dark shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="w-5 h-5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 11a3 3 0 100-6 3 3 0 000 6z" />
                                </svg>
                            </span>
                            <strong>Endereço:</strong>
                            {!! $endereco->endereco !!}
                        </p>

                        <p class="mb-2 flex items-start">
                            <!-- ícone de telefone -->
                            <span class="w-5 h-5 mr-2 text-dark shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.518 4.556a1 1 0 01-.232.98L8.91 11.91a11.042 11.042 0 005.179 5.179l1.69-1.69a1 1 0 01.98-.232l4.556 1.518A1 1 0 0121 17.72V21a2 2 0 01-2 2A19 19 0 013 5z" />
                                </svg>
                            </span>
                            <strong>Telefone:</strong>
                            <a class="ml-2 underline"
                                href="tel:{{ preg_replace('/\D+/', '', $endereco->telefone) }}">{{ $endereco->telefone }}</a>
                        </p>

                        <p class="mb-2 flex items-start">
                            <!-- ícone de email -->
                            <span class="w-5 h-5 mr-2 text-dark shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8V6a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                </svg>
                            </span>
                            <strong>Email:</strong>
                            <a class="ml-2 underline" href="mailto:{{ $endereco->email }}">{{ $endereco->email }}</a>
                        </p>
                    </div>
                </div>
            @else
                <p>Informações de contato não disponíveis.</p>
            @endif
        </div>
        </div>

        @foreach ($equipes as $equipe)
            <div x-show="openModalEquipe === {{ $loop->index }}" @keydown.escape.window="openModalEquipe = null"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center p-4 z-[100]"
                style="display: none;">
                <div @click="openModalEquipe = null" class="absolute inset-0"></div>

                <div class="relative bg-white rounded-lg shadow-xl w-full max-w-3xl overflow-hidden mx-auto">

                    <button @click="openModalEquipe = null"
                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-800 z-10 p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <div class="grid md:grid-cols-3">
                        <div class="md:col-span-1">
                            <img src="{{ asset('img/' . $equipe->foto) }}" alt="{{ $equipe->nome }}"
                                class="object-cover">
                        </div>

                        <div class="md:col-span-2 p-6 md:p-8 text-gray-800 overflow-y-auto" style="max-height: 80vh;">
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">
                                {{ $equipe->cargo }}</p>
                            <h2 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900">{{ $equipe->nome }}
                            </h2>

                            <div class="text-sm md:text-base space-y-4 leading-relaxed prose max-w-none">
                                {!! $equipe->descricao !!}
                            </div>

                            @if ($equipe->links)
                                <div class="text-sm md:text-base space-y-4 leading-relaxed prose max-w-none mt-4">
                                    {!! $equipe->links !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sections = ["instituto", "equipe", "projetos", "missao", "areas", "noticias", "contato"];

            // Reabre o modal de notícias se houver paginação ou busca
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('page') || urlParams.has('search_noticias')) {
                const noticiasBox = document.getElementById('noticias');
                if (noticiasBox) {
                    noticiasBox.classList.remove('hidden');
                }
            }

            sections.forEach(id => {
                // CORREÇÃO: Usar querySelectorAll para pegar links do desktop E mobile
                const links = document.querySelectorAll(`[data-section="${id}"]`);
                const box = document.getElementById(id);

                // CORREÇÃO: Checar links.length
                if (links.length > 0 && box) {

                    // CORREÇÃO: Aplicar evento a CADA link
                    links.forEach(link => {
                        link.addEventListener("click", (e) => {
                            e.preventDefault();

                            // Fecha os outros
                            sections.forEach(other => {
                                if (other !== id) document.getElementById(other)
                                    .classList.add("hidden");
                            });

                            // Alterna o atual
                            box.classList.toggle("hidden");

                            // CORREÇÃO: Bloco de scroll REMOVIDO para evitar bugs no mobile
                            /*
                            if (!box.classList.contains("hidden")) {
                                box.scrollIntoView({
                                    behavior: "smooth",
                                    block: "center"
                                });
                            }
                            */
                        });
                    });
                }
            });
        });
    </script>

    <style>
        .pagination-links nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-links span[aria-current="page"] span,
        .pagination-links a {
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            margin: 0 0.125rem;
        }

        .pagination-links span[aria-current="page"] span {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: bold;
        }

        .pagination-links a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .pagination-links span[aria-disabled="true"] span {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
@endsection
