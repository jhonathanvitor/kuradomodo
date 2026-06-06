@extends('layouts.app')

{{-- Use o layout principal do seu site --}}

@section('title', $post->title)

{{-- Define o título da página como o título do post --}}

@section('content')
    <div class="container mx-auto px-4 py-8 pt-24">
        {{-- pt-24 para dar espaço abaixo do header fixo --}}

        <article class="max-w-3xl mx-auto bg-white p-6 md:p-10 rounded-lg shadow-lg">

            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ $post->title }}
            </h1>

            <p class="text-gray-600 text-sm mb-6">
                Publicado em: {{ \Carbon\Carbon::parse($post->date)->format('d/m/Y') }}
            </p>

            @php
                // --- INÍCIO DA LÓGICA DO VÍDEO (VERSÃO CORRIGIDA) ---

                // 1. Pega o conteúdo salvo do Trix
                $content = $post->context;

                // 2. Define o padrão RegEx para encontrar APENAS a tag <a> que leva ao YouTube
                //    (Esta regra é mais flexível e vai funcionar)
                $youtubeRegex = '~<a href="https?://(?:www\.)?(?:youtube\.com/(?:watch\?v=|embed/)|youtu\.be/)([a-zA-Z0-9_-]{11}).*?">.*?</a>~i';

                // 3. Define o HTML que irá substituir a tag <a>
                //    (Isto requer o plugin @tailwindcss/aspect-ratio no seu tailwind.config.js)
                $responsiveWrapper = '<div class="my-6 shadow-md rounded-lg overflow-hidden">
                                    <div class="relative w-full" style="padding-top: 56.25%;">
                                        <iframe src="https://www.youtube.com/embed/$1"
                                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                class="absolute top-0 left-0 w-full h-full">

                                        </iframe>
                                    </div>
                                     </div>';

                // 4. Executa a substituição
                $processedContext = preg_replace($youtubeRegex, $responsiveWrapper, $content);

                // --- FIM DA LÓGICA DO VÍDEO ---
            @endphp


            {{-- Classe 'prose' do Tailwind para formatar o HTML salvo --}}
            <div class="prose prose-lg max-w-none text-gray-800">

                {{-- Usa {!! !!} para renderizar a variável que acabamos de processar --}}
                {!! $processedContext !!}

            </div>

            <hr class="my-8">

            <a href="{{ route('index') }}" class="text-red-600 hover:underline">
                &larr; Voltar para a página inicial
            </a>

        </article>

    </div>
@endsection
