<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Categoria;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $posts = DB::select(
            'SELECT COUNT(*) as total FROM posts'
        );
        $categorias = Categoria::all();
        return view('admin.home.index', compact('user', 'categorias', 'posts'));
    }
}
