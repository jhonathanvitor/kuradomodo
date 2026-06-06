<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function getPosts(Request $request)
    {

        // Pegue o termo de busca da URL (ex: ?search_noticias=...)
        $search = $request->input('search_noticias');

        $query = DB::table('posts')
            ->where('status', 'published')
            ->where('categoria_id', '1')
            ->orderBy('date', 'desc');

        // Se houver um termo de busca, aplica o filtro
        if ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }

        $posts = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return $posts;
    }

    function getPostProjetos()
    {
        $projetos = DB::table('posts')
            ->where('status', 'published')
            ->where('categoria_id', '2')
            ->where('featured', '1')
            ->orderBy('date', 'desc')
            ->paginate(10);

        return $projetos;
    }

    function getEquipes()
    {
        $equipes = DB::table('equipes')
            ->orderBy('ordem', 'asc')
            ->get();
        return $equipes;
    }

    function getEndereco()
    {
        $endereco = Endereco::first();
        return $endereco;
    }

    public function showPost($slug)
    {
        $post = DB::table('posts')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first();

        if (!$post) {
            abort(404);
        }

        // Corrigindo a view para a que criamos (assumindo que seja 'pages.post.show')
        return view('pages.noticias.index', compact('post'));
    }

    public function showProjeto($slug)
    {
        $projetos = DB::table('posts')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first();

        if (!$projetos) {
            abort(404);
        }

        // Corrigindo a view para a que criamos (assumindo que seja 'pages.projetos.show')
        return view('pages.projetos.index', compact('projetos'));
    }

    /**
     * Página inicial
     */
    public function index(Request $request)
    {
        $equipes = $this->getEquipes();
        $endereco = $this->getEndereco();
        $posts = $this->getPosts($request);
        $projetos = $this->getPostProjetos();

        // CORREÇÃO AQUI: Adicione 'request' ao compact
        return view('pages.home.index', compact('equipes', 'endereco', 'posts', 'request', 'projetos'));
    }
}
