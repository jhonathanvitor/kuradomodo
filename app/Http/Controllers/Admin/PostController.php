<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Imagem;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
            ->leftJoin('categorias', 'posts.categoria_id', '=', 'categorias.id')
            ->leftJoin('imagens', 'posts.imagem_id', '=', 'imagens.id')
            ->select('posts.*', 'categorias.nome as category_name', 'imagens.path as image_path')
            ->orderBy('posts.featured', 'desc')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(10);

        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categorias = DB::table('categorias')->orderBy('nome')->get();
        $imagens = DB::table('imagens')->orderBy('created_at', 'desc')->get();

        return view('admin.post.criar', compact('categorias', 'imagens'));
    }

    public function edit($id)
    {
        // Buscar o post com relacionamento
        $post = Post::with('imagem')->findOrFail($id);

        // CORREÇÃO: Adicionar a URL completa da imagem ao objeto
        if ($post->imagem) {
            // Usa o disco 'public_images' para gerar a URL correta como atributo do modelo (não modifica propriedades privadas)
            $post->imagem->setAttribute('url', Storage::disk('public_images')->url($post->imagem->path));
        }

        $categorias = DB::table('categorias')->orderBy('nome')->get();
        $imagens = DB::table('imagens')->orderBy('created_at', 'desc')->get();

        return view('admin.post.editar', compact('post', 'categorias', 'imagens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'context' => 'required|string',
            'date' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
            'status' => 'required|in:draft,published,archived',
            'imagem_id' => 'nullable|exists:imagens,id'
        ]);

        $slug = Str::slug($request->title, '-');
        $count = DB::table('posts')->where('slug', 'LIKE', $slug . '%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        DB::table('posts')->insert([
            'slug' => $slug,
            'title' => $request->title,
            'description' => $request->description,
            'context' => $request->context,
            'date' => $request->date,
            'categoria_id' => $request->categoria_id,
            'imagem_id' => $request->imagem_id,
            'results' => $request->results ? json_encode($request->results) : null,
            'status' => $request->status,
            'featured' => $request->has('featured'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        if (!$post) {
            abort(404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'context' => 'required|string',
            'date' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
            'status' => 'required|in:draft,published,archived',
            'imagem_id' => 'nullable|exists:imagens,id'
        ]);

        $slug = Str::slug($request->title, '-');
        $count = DB::table('posts')->where('slug', 'LIKE', $slug . '%')->where('id', '!=', $id)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        DB::table('posts')->where('id', $id)->update([
            'slug' => $slug,
            'title' => $request->title,
            'description' => $request->description,
            'context' => $request->context,
            'date' => $request->date,
            'categoria_id' => $request->categoria_id,
            'imagem_id' => $request->imagem_id,
            'results' => $request->results ? json_encode($request->results) : null,
            'status' => $request->status,
            'featured' => $request->has('featured'),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        if (!$post) {
            abort(404);
        }

        DB::table('posts')->where('id', $id)->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post excluído com sucesso!');
    }
}
