@extends('layouts.admin.base')

@section('content')
    <div class="py-8 px-4 mx-auto max-w-5xl lg:py-16">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Gerenciamento da Equipe</h1>
                <p class="text-sm text-gray-500 mt-1">Arraste os cards para reordenar. A ordem é salva automaticamente.</p>
            </div>
            <a href="{{ route('admin.equipe.create') }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Novo Membro
            </a>
        </div>

        @if (session('success'))
            <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
            </div>
        @endif

        {{-- Toast de feedback do drag --}}
        <div id="toast-order" class="hidden fixed bottom-6 right-6 z-50 flex items-center gap-3 px-4 py-3 bg-gray-900 text-white text-sm rounded-lg shadow-lg transition-all">
            <svg id="toast-spinner" class="w-4 h-4 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
            <svg id="toast-check" class="w-4 h-4 text-green-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="toast-msg">Salvando ordem...</span>
        </div>

        {{-- Grid com drag-and-drop --}}
        <div id="equipe-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($equipes as $membro)
                <div class="equipe-card bg-white border border-gray-200 rounded-lg shadow-sm p-6 cursor-grab active:cursor-grabbing select-none transition-all duration-200"
                     draggable="true"
                     data-id="{{ $membro->id }}">

                    {{-- Drag handle indicator --}}
                    <div class="flex justify-between items-start mb-3">
                    <span class="text-gray-300 drag-handle" title="Arraste para reordenar">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM7 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-6 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                        </svg>
                    </span>
                        <span class="ordem-badge bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded-full">
                        Nº {{ $membro->ordem }}
                    </span>
                    </div>

                    <div class="flex flex-col items-center">
                        @if ($membro->foto)
                            @php $photoUrl = app('App\Http\Controllers\Admin\EquipeController')->getUrlFor($membro); @endphp
                            <img class="w-20 h-20 rounded-full mb-3 object-cover border-2 border-gray-200"
                                 src="{{ $photoUrl }}" alt="{{ e($membro->nome) }}">
                        @else
                            <div class="w-20 h-20 rounded-full mb-3 bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif

                        <h5 class="text-base font-bold text-gray-900 text-center">{{ $membro->nome }}</h5>
                        <p class="text-xs text-gray-500 mb-2">{{ $membro->cargo }}</p>
                        <p class="text-xs text-gray-600 text-center leading-relaxed">{{ Str::limit($membro->descricao, 80) }}</p>

                        @if ($membro->links && count((array)$membro->links) > 0)
                            <div class="mt-2 flex flex-wrap gap-1 justify-center">
                                @foreach ((array)$membro->links as $link)
                                    <a href="{{ $link }}" target="_blank"
                                       class="text-xs text-blue-600 hover:underline truncate max-w-[140px]"
                                       onclick="event.stopPropagation()">
                                        {{ parse_url($link, PHP_URL_HOST) ?? $link }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('admin.equipe.edit', $membro->id) }}"
                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                               onclick="event.stopPropagation()">
                                Editar
                            </a>
                            <form action="{{ route('admin.equipe.destroy', $membro->id) }}" method="POST" class="inline"
                                  onsubmit="event.stopPropagation()">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700"
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

    <style>
        .equipe-card.dragging {
            opacity: 0.4;
            transform: scale(0.97);
            border: 2px dashed #3b82f6;
        }
        .equipe-card.drag-over {
            border: 2px dashed #10b981;
            background-color: #f0fdf4;
            transform: scale(1.02);
        }
    </style>

    <script>
        const grid      = document.getElementById('equipe-grid');
        const toast     = document.getElementById('toast-order');
        const toastMsg  = document.getElementById('toast-msg');
        const spinner   = document.getElementById('toast-spinner');
        const checkIcon = document.getElementById('toast-check');
        let toastTimer;

        function showToast(msg, type = 'loading') {
            clearTimeout(toastTimer);
            toast.classList.remove('hidden');
            toastMsg.textContent = msg;
            spinner.classList.toggle('hidden', type !== 'loading');
            checkIcon.classList.toggle('hidden', type !== 'success');
            if (type === 'success') {
                toastTimer = setTimeout(() => toast.classList.add('hidden'), 2500);
            }
        }

        // ---- Drag & Drop ----
        let dragSrc = null;

        grid.addEventListener('dragstart', e => {
            const card = e.target.closest('.equipe-card');
            if (!card) return;
            dragSrc = card;
            card.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
        });

        grid.addEventListener('dragend', e => {
            const card = e.target.closest('.equipe-card');
            if (card) card.classList.remove('dragging');
            document.querySelectorAll('.equipe-card').forEach(c => c.classList.remove('drag-over'));
            saveOrder();
        });

        grid.addEventListener('dragover', e => {
            e.preventDefault();
            const target = e.target.closest('.equipe-card');
            if (!target || target === dragSrc) return;

            // Reposiciona visualmente
            const rect     = target.getBoundingClientRect();
            const midpoint = rect.top + rect.height / 2;
            if (e.clientY < midpoint) {
                grid.insertBefore(dragSrc, target);
            } else {
                grid.insertBefore(dragSrc, target.nextSibling);
            }
        });

        grid.addEventListener('dragenter', e => {
            const target = e.target.closest('.equipe-card');
            if (target && target !== dragSrc) target.classList.add('drag-over');
        });

        grid.addEventListener('dragleave', e => {
            const target = e.target.closest('.equipe-card');
            if (target) target.classList.remove('drag-over');
        });

        // ---- Atualiza badges de ordem visualmente ----
        function updateBadges() {
            document.querySelectorAll('.equipe-card').forEach((card, index) => {
                const badge = card.querySelector('.ordem-badge');
                if (badge) badge.textContent = 'Nº ' + index;
            });
        }

        // ---- Salva nova ordem via AJAX ----
        function saveOrder() {
            updateBadges();
            const ids = [...document.querySelectorAll('.equipe-card')].map(c => c.dataset.id);

            showToast('Salvando ordem...', 'loading');

            fetch('{{ route("admin.equipe.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ids })
            })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        showToast('Ordem salva!', 'success');
                    } else {
                        showToast('Erro ao salvar.', 'error');
                    }
                })
                .catch(() => showToast('Erro ao salvar.', 'error'));
        }
    </script>
@endsection
