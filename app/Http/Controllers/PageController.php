<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $enderecos = DB::select('SELECT * FROM endereco');
        return view('admin.home.index', compact('enderecos'));
    }
}
