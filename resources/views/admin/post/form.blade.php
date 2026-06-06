{{-- resources/views/admin/post/form.blade.php --}}

@php
    $isEdit = isset($post) && $post->id;
    $formAction = $isEdit ? route('admin.posts.update', $post->id) : route('admin.posts.store');
@endphp

<form action="{{ $formAction }}" method="POST" enctype="multipart/form-data"
    id="{{ $isEdit ? 'formEditarPost' : 'formCriarPost' }}" class="p-8">

    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">

            <div class="space-y-2">
                <label for="post_title" class="block text-sm font-medium text-gray-700">
                    Título do Post <span class="text-red-400">*</span>
                </label>
                <input type="text" id="post_title" name="title"
                    value="{{ old('title', $isEdit ? $post->title : '') }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all duration-200"
                    placeholder="Ex: Título do seu post" required>
            </div>

            <div class="space-y-2">
                <label for="post_description_trix" class="block text-sm font-medium text-gray-700">
                    Descrição Resumida <span class="text-red-400">*</span>
                </label>
                <input type="text" id="post_description" name="description"
                    value="{{ old('description', $isEdit ? $post->description : '') }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all duration-200"
                    placeholder="Ex: Descrição do seu post" required>
            </div>

            <div class="space-y-2">
                <label for="post_context_trix" class="block text-sm font-medium text-gray-700">
                    Contexto (Conteúdo Principal) <span class="text-red-400">*</span>
                </label>
                <input id="post_context_trix" name="context" type="hidden"
                    value="{{ old('context', $isEdit ? $post->context : '') }}">
                <trix-editor input="post_context_trix" id="trix-context"
                    class="trix-content bg-gray-50 border border-gray-200 rounded-lg min-h-[250px] p-4 focus:ring-2 focus:ring-blue-100 focus:border-blue-300"></trix-editor>
            </div>

            <div class="space-y-2">
                <label for="post_results" class="block text-sm font-medium text-gray-700">
                    Resultados (Opcional)
                </label>
                <textarea id="post_results" name="results" rows="4"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all duration-200">{{ old('results', $isEdit ? $post->results : '') }}</textarea>
            </div>

        </div>

        <div class="lg:col-span-1 space-y-8">

            <div class="p-6 bg-gray-50 rounded-lg border border-gray-100 space-y-2">
                <label for="post_categoria" class="block text-sm font-medium text-gray-700">Categoria</label>
                @if (isset($categorias))
                    <select id="post_categoria" name="categoria_id"
                        class="w-full px-4 py-3 bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all duration-200">
                        <option value="">Nenhuma Categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @if (old('categoria_id', $isEdit ? $post->categoria_id : '') == $categoria->id) selected @endif>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <p class="text-sm text-red-500">Erro: A variável $categorias não foi passada para o formulário.</p>
                @endif
            </div>

            @php
                $currentImageId = old('imagem_id', $isEdit ? $post->imagem_id : null);
                $currentImageUrl = null;

                if ($isEdit && $post->imagem_id == $currentImageId && $post->imagem) {
                    $currentImageUrl = $post->imagem->url;
                }
            @endphp

            <div class="p-6 bg-gray-50 rounded-lg border border-gray-100 space-y-2">
                <label class="block text-sm font-medium text-gray-700 mb-3">Imagem de Destaque</label>

                <input type="hidden" id="featured_image_id" name="imagem_id" value="{{ $currentImageId }}">

                <div id="featured_image_preview" class="mb-3 {{ $currentImageUrl ? '' : 'hidden' }}">
                    <div class="relative rounded-lg overflow-hidden border-2 border-blue-500">
                        <img id="featured_image_thumbnail" src="{{ $currentImageUrl ?? '' }}" alt="Imagem selecionada"
                            class="w-full h-48 object-cover">
                        <button type="button" id="remove_featured_image"
                            class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 shadow-lg transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="button" id="select_featured_image_btn"
                    class="w-full px-4 py-3 bg-white border-2 border-dashed border-gray-300 hover:border-blue-500 rounded-lg text-gray-600 hover:text-blue-600 font-medium transition-all duration-200 flex items-center justify-center space-x-2 {{ $currentImageUrl ? 'hidden' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Selecionar Imagem de Destaque</span>
                </button>
            </div>

            <div class="p-6 bg-gray-50 rounded-lg border border-gray-100 space-y-2">
                <label for="post_date" class="block text-sm font-medium text-gray-700">Data de Publicação</label>
                <input type="date" id="post_date" name="date"
                    value="{{ old('date', $isEdit ? \Carbon\Carbon::parse($post->date)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                    class="w-full px-4 py-3 bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all duration-200">
            </div>

            <div class="p-6 bg-gray-50 rounded-lg border border-gray-100 space-y-2">
                <label for="post_status" class="block text-sm font-medium text-gray-700">Status</label>
                @php
                    $currentStatus = old('status', $isEdit ? $post->status : 'published');
                @endphp
                <select id="post_status" name="status"
                    class="w-full px-4 py-3 bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all duration-200">
                    <option value="published" @if ($currentStatus == 'published') selected @endif>Publicado</option>
                    <option value="draft" @if ($currentStatus == 'draft') selected @endif>Rascunho</option>
                </select>
            </div>

            <div class="p-6 bg-gray-50 rounded-lg border border-gray-100 space-y-2">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" name="featured" value="1"
                        @if (old('featured', $isEdit ? $post->featured : false)) checked @endif
                        class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <span class="text-sm font-medium text-gray-700">Marcar como Projeto</span>
                </label>
            </div>
        </div>
    </div>

    <div class="flex justify-end pt-8 mt-8 border-t border-gray-100">
        <button type="submit"
            class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
            {{ $isEdit ? 'Atualizar Post' : 'Publicar Post' }}
        </button>
    </div>
</form>

{{-- Modal de Galeria de Imagens --}}
<div id="imageGalleryModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full bg-gray-900 bg-opacity-50 transition-opacity duration-300">
    <div class="relative w-full max-w-4xl max-h-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-xl">
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Galeria de Imagens
                </h3>
                <button type="button" id="closeGalleryModal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Fechar modal</span>
                </button>
            </div>

            <div class="p-4 border-b">
                <div class="flex space-x-4">
                    <button id="tabSelect" data-tab="select"
                        class="tab-button px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600">
                        Selecionar da Galeria
                    </button>
                    <button id="tabUpload" data-tab="upload"
                        class="tab-button px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        Enviar Nova Imagem
                    </button>
                </div>
            </div>

            <div class="p-6 space-y-6" style="min-height: 50vh;">

                {{-- Aba: Selecionar da Galeria --}}
                <div id="tabContentSelect" class="tab-content">
                    <div id="galleryLoading" class="text-center text-gray-500 py-8">
                        <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-blue-600"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        A carregar imagens...
                    </div>
                    <div id="galleryGrid"
                        class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4 max-h-[60vh] overflow-y-auto">
                    </div>
                    <div id="galleryError" class="hidden text-center text-red-500 py-8">
                        <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p id="galleryErrorMessage">Erro ao carregar imagens</p>
                    </div>
                </div>

                {{-- Aba: Upload Nova Imagem --}}
                <div id="tabContentUpload" class="tab-content hidden">
                    <form id="modalUploadForm" class="space-y-4">
                        <div class="flex items-center justify-center w-full">
                            <label for="modalFileInput"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6"
                                    id="uploadPlaceholder">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Clique para
                                            enviar</span> ou arraste e solte</p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG ou WEBP (MAX. 4MB)</p>
                                </div>
                                <!-- Área da miniatura -->
                                <div id="imagePreviewContainer" class="hidden w-full h-full p-4">
                                    <img id="imagePreview" class="w-full h-full object-contain rounded-lg"
                                        src="" alt="Preview">
                                    <button type="button" id="removePreview"
                                        class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <input id="modalFileInput" name="file" type="file" accept="image/*"
                                    class="hidden" />
                            </label>
                        </div>

                        <!-- Informações do arquivo -->
                        <div id="modalUploadPreview" class="hidden text-center bg-gray-50 p-4 rounded-lg">
                            <p class="font-medium text-gray-700 mb-2">Ficheiro selecionado:</p>
                            <p id="modalFileName" class="text-sm text-gray-600 mb-1"></p>
                            <p id="modalFileSize" class="text-xs text-gray-500"></p>
                        </div>

                        <!-- Status do upload -->
                        <div id="modalUploadStatus" class="hidden">
                            <div class="flex items-center justify-center text-blue-600">
                                <svg class="animate-spin h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <p>A enviar, por favor aguarde...</p>
                            </div>
                        </div>

                        <!-- Erro do upload -->
                        <div id="modalUploadError" class="hidden text-center text-red-600 p-4 bg-red-50 rounded-lg">
                            <p id="modalUploadErrorMessage"></p>
                        </div>

                        <button type="submit" id="modalUploadSubmit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:opacity-50 disabled:cursor-not-allowed">
                            Enviar e Inserir Imagem
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        trix-editor {
            border-radius: 0.5rem;
            min-height: 120px;
        }

        trix-toolbar {
            border-radius: 0.5rem 0.5rem 0 0;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        trix-toolbar .trix-button-group {
            border-color: #e5e7eb;
        }

        trix-toolbar .trix-button {
            color: #6b7280;
            border-radius: 0.375rem;
            margin: 2px;
        }

        trix-toolbar .trix-button:hover {
            background: #e5e7eb;
        }

        trix-toolbar .trix-button.trix-active {
            background: #dbeafe;
            color: #2563eb;
        }

        #uploadPlaceholder {
            transition: all 0.3s ease;
        }

        #imagePreviewContainer {
            position: relative;
            transition: all 0.3s ease;
        }

        #removePreview {
            transition: all 0.2s ease;
        }

        /* Garantir que o container do upload mantenha o tamanho */
        .flex-col.items-center.justify-center.w-full.h-64 {
            position: relative;
            overflow: hidden;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script>
        // === Variáveis Globais ===
        const trixUploadUrl = "{{ route('admin.imagens.trix-upload') }}";
        const csrfToken = "{{ csrf_token() }}";
        const galleryListUrl = "{{ route('admin.imagens.list') }}";

        let trixEditorElement = null;
        let modalMode = 'trix'; // 'trix' ou 'featured'

        // === 1. Upload via Drag-and-Drop no Trix ===
        document.addEventListener("trix-attachment-add", function(event) {
            if (event.attachment.file) {
                uploadTrixFile(event.attachment);
            }
        });

        function uploadTrixFile(attachment) {
            const formData = new FormData();
            formData.append("file", attachment.file);
            formData.append("_token", csrfToken);

            const progressElement = attachment.attachment.progressElement;
            if (progressElement) {
                progressElement.style.width = "0%";
            }

            fetch(trixUploadUrl, {
                    method: "POST",
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Falha no upload. Status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.url) {
                        attachment.setAttributes({
                            url: data.url,
                            href: data.url,
                            alt: data.alt_text || ''
                        });
                        if (progressElement) {
                            progressElement.style.width = "100%";
                        }
                    } else if (data.error) {
                        throw new Error(data.error);
                    }
                })
                .catch(error => {
                    console.error("Erro no upload do Trix:", error.message);
                    attachment.remove();
                    alert("Falha ao enviar a imagem: " + error.message);
                });
        }

        // === 2. Substituir botão "Anexar" do Trix ===
        document.addEventListener("trix-initialize", function(event) {
            const editorEl = event.target;
            if (!editorEl.toolbarElement) return;

            const toolbar = editorEl.toolbarElement;
            const attachButton = toolbar.querySelector("[data-trix-action='attachFiles']");

            if (attachButton) {
                const newButton = attachButton.cloneNode(true);
                newButton.dataset.trixAction = '';
                newButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    trixEditorElement = editorEl;
                    openGalleryModal('trix');
                });
                attachButton.parentNode.replaceChild(newButton, attachButton);
            }
        });

        // === 3. Elementos do DOM ===
        const modal = document.getElementById('imageGalleryModal');
        const closeModalButton = document.getElementById('closeGalleryModal');
        const tabSelect = document.getElementById('tabSelect');
        const tabUpload = document.getElementById('tabUpload');
        const contentSelect = document.getElementById('tabContentSelect');
        const contentUpload = document.getElementById('tabContentUpload');
        const galleryGrid = document.getElementById('galleryGrid');
        const galleryLoading = document.getElementById('galleryLoading');
        const galleryError = document.getElementById('galleryError');
        const galleryErrorMessage = document.getElementById('galleryErrorMessage');
        const uploadForm = document.getElementById('modalUploadForm');
        const fileInput = document.getElementById('modalFileInput');
        const uploadPreview = document.getElementById('modalUploadPreview');
        const fileNameSpan = document.getElementById('modalFileName');
        const modalFileSize = document.getElementById('modalFileSize');
        const uploadStatus = document.getElementById('modalUploadStatus');
        const uploadError = document.getElementById('modalUploadError');
        const uploadErrorMessage = document.getElementById('modalUploadErrorMessage');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const removePreviewBtn = document.getElementById('removePreview');
        const modalUploadSubmit = document.getElementById('modalUploadSubmit');

        // Elementos da Imagem de Destaque
        const selectFeaturedBtn = document.getElementById('select_featured_image_btn');
        const removeFeaturedBtn = document.getElementById('remove_featured_image');
        const featuredPreview = document.getElementById('featured_image_preview');
        const featuredThumbnail = document.getElementById('featured_image_thumbnail');
        const featuredInputId = document.getElementById('featured_image_id');

        // === 4. Funções de Controle do Modal ===
        function openGalleryModal(mode = 'trix') {
            modalMode = mode;
            modal.classList.remove('hidden');
            modal.classList.add('flex', 'items-center', 'justify-center');
            loadGalleryImages();
            showTab('select');
            resetUploadForm();
        }

        function closeGalleryModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex', 'items-center', 'justify-center');
            trixEditorElement = null;
            modalMode = 'trix';
        }

        function showTab(tabName) {
            if (tabName === 'select') {
                contentSelect.classList.remove('hidden');
                contentUpload.classList.add('hidden');
                tabSelect.classList.add('text-blue-600', 'border-blue-600');
                tabSelect.classList.remove('text-gray-500', 'hover:text-gray-700');
                tabUpload.classList.add('text-gray-500', 'hover:text-gray-700');
                tabUpload.classList.remove('text-blue-600', 'border-blue-600');
            } else {
                contentSelect.classList.add('hidden');
                contentUpload.classList.remove('hidden');
                tabUpload.classList.add('text-blue-600', 'border-blue-600');
                tabUpload.classList.remove('text-gray-500', 'hover:text-gray-700');
                tabSelect.classList.add('text-gray-500', 'hover:text-gray-700');
                tabSelect.classList.remove('text-blue-600', 'border-blue-600');
            }
        }

        function insertImageIntoTrix(imageUrl, altText) {
            if (!trixEditorElement) return;
            const editor = trixEditorElement.editor;
            const html = `
            <figure class="attachment attachment--preview">
                <img src="${imageUrl}" alt="${altText || ''}">
                <figcaption class="attachment__caption">${altText || ''}</figcaption>
            </figure>
        `;
            editor.insertHTML(html);
        }

        function setFeaturedImage(id, url) {
            featuredInputId.value = id;
            featuredThumbnail.src = url;
            featuredPreview.classList.remove('hidden');
            if (selectFeaturedBtn) selectFeaturedBtn.classList.add('hidden');
        }

        function removeFeaturedImage() {
            featuredInputId.value = '';
            featuredThumbnail.src = '';
            featuredPreview.classList.add('hidden');
            if (selectFeaturedBtn) selectFeaturedBtn.classList.remove('hidden');
        }

        // === 5. Carregar Galeria ===
        async function loadGalleryImages() {
            galleryLoading.classList.remove('hidden');
            galleryGrid.innerHTML = '';
            galleryError.classList.add('hidden');

            try {
                const response = await fetch(galleryListUrl);

                if (!response.ok) {
                    throw new Error('Falha ao carregar: ' + response.status);
                }

                const images = await response.json();

                if (images.length === 0) {
                    galleryGrid.innerHTML =
                        '<p class="text-gray-500 col-span-full text-center py-8">Nenhuma imagem encontrada na galeria.</p>';
                } else {
                    images.forEach(img => {
                        const imgContainer = document.createElement('div');
                        imgContainer.className =
                            'relative cursor-pointer group rounded-lg overflow-hidden border border-gray-200 hover:border-blue-500 transition-all';

                        const imgElement = document.createElement('img');
                        imgElement.src = img.url || img.path;
                        imgElement.alt = img.alt || img.alt_text || '';
                        imgElement.className =
                            'w-full h-28 object-cover transition-transform duration-300 group-hover:scale-110';

                        imgElement.onerror = function() {
                            this.src =
                                'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="100" height="100"%3E%3Crect fill="%23ddd" width="100" height="100"/%3E%3Ctext fill="%23999" x="50%25" y="50%25" dominant-baseline="middle" text-anchor="middle"%3EErro%3C/text%3E%3C/svg%3E';
                        };

                        imgContainer.appendChild(imgElement);

                        imgContainer.addEventListener('click', () => {
                            if (modalMode === 'trix') {
                                insertImageIntoTrix(img.url || img.path, img.alt || img.alt_text || '');
                            } else if (modalMode === 'featured') {
                                setFeaturedImage(img.id, img.url || img.path);
                            }
                            closeGalleryModal();
                        });

                        galleryGrid.appendChild(imgContainer);
                    });
                }

            } catch (error) {
                console.error("Erro ao carregar galeria:", error);
                galleryError.classList.remove('hidden');
                galleryErrorMessage.textContent = 'Ocorreu um erro ao carregar as imagens: ' + error.message;
            } finally {
                galleryLoading.classList.add('hidden');
            }
        }

        // === 6. Funções de Upload ===
        function resetUploadForm() {
            fileInput.value = '';
            resetPreview();
            uploadError.classList.add('hidden');
            uploadStatus.classList.add('hidden');
        }

        function resetPreview() {
            uploadPlaceholder.classList.remove('hidden');
            imagePreviewContainer.classList.add('hidden');
            imagePreview.src = '';
            uploadPreview.classList.add('hidden');
        }

        function showUploadError(message) {
            uploadError.classList.remove('hidden');
            uploadErrorMessage.textContent = message;
        }

        // === 7. Preview do arquivo selecionado ===
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                fileNameSpan.textContent = file.name;
                modalFileSize.textContent = `Tamanho: ${(file.size / 1024 / 1024).toFixed(2)} MB`;

                // Mostrar preview da imagem
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    uploadPlaceholder.classList.add('hidden');
                    imagePreviewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);

                uploadPreview.classList.remove('hidden');
            } else {
                resetPreview();
            }
        });

        // Remover preview
        removePreviewBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            resetPreview();
            fileInput.value = '';
        });

        // === 8. Submit do formulário de upload ===
        uploadForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Limpar erros anteriores
            uploadError.classList.add('hidden');

            if (fileInput.files.length === 0) {
                showUploadError('Por favor, selecione um ficheiro.');
                return;
            }

            const file = fileInput.files[0];

            // Validar tipo de arquivo
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/svg+xml'];
            if (!allowedTypes.includes(file.type)) {
                showUploadError('Tipo de arquivo não permitido. Use JPG, PNG, WEBP ou SVG.');
                return;
            }

            // Validar tamanho (4MB)
            if (file.size > 4 * 1024 * 1024) {
                showUploadError('O arquivo é muito grande. Tamanho máximo: 4MB.');
                return;
            }

            const formData = new FormData();
            formData.append('file', file);
            formData.append('_token', csrfToken);

            // Mostrar status de upload
            uploadStatus.classList.remove('hidden');
            modalUploadSubmit.disabled = true;

            try {
                const response = await fetch(trixUploadUrl, {
                    method: "POST",
                    body: formData,
                });

                console.log("Resposta do servidor:", response);

                let data;
                try {
                    data = await response.json();
                } catch (jsonError) {
                    console.error("Erro ao parsear JSON:", jsonError);
                    throw new Error('Resposta inválida do servidor: não é JSON válido');
                }

                if (!response.ok) {
                    // Se a resposta não é OK, verifica se há mensagem de erro no JSON
                    const errorMessage = data.error || data.message ||
                        `Erro ${response.status}: ${response.statusText}`;
                    throw new Error(errorMessage);
                }

                // Verifica se a resposta tem a estrutura esperada
                if (data && data.url) {
                    // Para compatibilidade, verifica tanto 'id' quanto 'image_id'
                    const imageId = data.id || data.image_id;

                    if (modalMode === 'trix') {
                        insertImageIntoTrix(data.url, data.alt_text || '');
                    } else if (modalMode === 'featured') {
                        setFeaturedImage(imageId, data.url);
                    }

                    closeGalleryModal();
                    uploadForm.reset();
                    resetPreview();
                } else {
                    throw new Error('Resposta do servidor não contém URL da imagem');
                }

            } catch (error) {
                console.error("Erro no upload do modal:", error);
                showUploadError("Falha ao enviar a imagem: " + error.message);
            } finally {
                uploadStatus.classList.add('hidden');
                modalUploadSubmit.disabled = false;
            }
        });

        // === 9. Event Listeners ===
        closeModalButton.addEventListener('click', closeGalleryModal);
        tabSelect.addEventListener('click', () => showTab('select'));
        tabUpload.addEventListener('click', () => showTab('upload'));

        if (selectFeaturedBtn) {
            selectFeaturedBtn.addEventListener('click', () => openGalleryModal('featured'));
        }

        if (removeFeaturedBtn) {
            removeFeaturedBtn.addEventListener('click', removeFeaturedImage);
        }

        // Fechar modal ao clicar fora
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeGalleryModal();
            }
        });

        // Debug: Log quando o script é carregado
        console.log('Script de galeria carregado com sucesso');
        console.log('URLs configuradas:', {
            trixUploadUrl,
            galleryListUrl
        });
    </script>
@endpush
