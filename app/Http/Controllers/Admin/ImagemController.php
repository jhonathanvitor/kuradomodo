<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Imagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagemController extends Controller
{
    // Lista todas as imagens na biblioteca
    public function index()
    {
        $imagens = Imagem::latest()->paginate(20);
        return view('admin.imagens.index', compact('imagens'));
    }

    // Returns a public URL for a given Imagem model instance
    public function getUrlFor(Imagem $imagem): string
    {
        // Build the public URL from the disk config if present, otherwise fall back to asset()
        $baseUrl = config('filesystems.disks.public_images.url');
        if ($baseUrl) {
            return rtrim($baseUrl, '/') . '/' . ltrim($imagem->path, '/');
        }

        return asset($imagem->path);
    }

    public function listJson()
    {
        // Obtemos as imagens mais recentes
        $imagens = Imagem::latest()->get();

        // Mapeamos os resultados para incluir a URL pública
        $imagensComUrl = $imagens->map(function($imagem) {
            return [
                'id' => $imagem->id,
                'url' => $this->getUrlFor($imagem), // Usamos o método que já existe!
                'alt' => $imagem->alt_text ?? pathinfo($imagem->filename, PATHINFO_FILENAME),
            ];
        });

        return response()->json($imagensComUrl);
    }

    /**
     * Lida com o upload de arquivos do editor Trix (e do nosso modal).
     */
    public function trixUpload(Request $request)
    {
        // 1. Validar o arquivo
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ]);

        $file = $request->file('file');

        // 2. Salvar no disco 'public_images' (ex: /public/img/uploads)
        $path = $file->store('uploads', 'public_images');

        $imagem = null;

        try {
            // 3. Criar o registro no banco de dados
            $imagem = Imagem::create([
                'path' => $path,
                'filename' => $file->getClientOriginalName(),
                'alt_text' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        } catch (\Exception $e) {
            // Se falhar ao salvar no DB, apague o arquivo
            Storage::disk('public_images')->delete($path);
            return response()->json(['error' => 'Falha ao registrar imagem no banco.'], 500);
        }

        // 4. Obter a URL usando o método 'getUrlFor'
        $url = $this->getUrlFor($imagem);

        // 5. Retornar a URL para o Trix (ou para o nosso modal)
        // Retornamos também o alt_text para usar na inserção
        return response()->json([
            'url' => $url,
            'alt_text' => $imagem->alt_text
        ]);
    }

    // Salva a nova imagem
    public function store(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $file = $request->file('imagem');

        // --- CORREÇÃO AQUI ---
        // Salva no disco 'public_images' (na pasta public/img/uploads)
        // A linha errada 'Storage::disk('public_images')->delete(...)' foi removida.
        $path = $file->store('uploads', 'public_images');
        // --------------------

        Imagem::create([
            'path' => $path, // Agora a variável $path existe
            'filename' => $file->getClientOriginalName(),
            'alt_text' => $request->alt_text,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        return redirect()->back()->with('success', 'Imagem enviada com sucesso!');
    }

    // Deleta uma imagem
    public function destroy(Imagem $imagem) // Route-Model Binding
    {
        // --- CORREÇÃO AQUI ---
        // Deleta o arquivo do disco 'public_images'
        Storage::disk('public_images')->delete($imagem->path);
        // --------------------

        // Deleta o registro do banco
        $imagem->delete();

        return redirect()->back()->with('success', 'Imagem deletada com sucesso!');
    }

    /**
     * Lida com uploads de imagens do Trix Editor.
     * Salva a imagem no disco e na tabela 'imagens'.
     * Retorna a URL para o Trix.
     */
    public function trix_upload(Request $request)
    {
        // 1. Validar o arquivo
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ]);

        $file = $request->file('file');

        // 2. Salvar no disco 'public_images' (ex: /public/img/uploads)
        $path = $file->store('uploads', 'public_images');

        $imagem = null;

        try {
            // 3. Criar o registro no banco de dados (seu "banco de imagens")
            // E capturar o modelo criado na variável $imagem
            $imagem = Imagem::create([
                'path' => $path,
                'filename' => $file->getClientOriginalName(),
                'alt_text' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), // Usa o nome do arquivo sem extensão
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        } catch (\Exception $e) {
            // Se falhar ao salvar no DB, apague o arquivo para não deixar lixo
            Storage::disk('public_images')->delete($path);
            // Retorna um erro para o Trix
            return response()->json(['error' => 'Falha ao registrar imagem no banco de dados.'], 500);
        }

        // 4. Obter a URL usando o método 'getUrlFor' que JÁ EXISTE no seu controller
        // Esta é a correção
        $url = $this->getUrlFor($imagem);

        // 5. Retornar a URL para o Trix
        return response()->json(['url' => $url]);
    }

    /**
     * O 'storage:link' não é mais necessário para este disco.
     */
}
