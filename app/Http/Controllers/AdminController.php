<?php

namespace App\Http\Controllers;

use App\Artigo;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::count();
        $artigos = Artigo::count();
        $autores = User::where("autor", "=", "S")->count();

        $lista_migalhas = json_encode([
            ["titulo" => "Admin",                "url" => ""]
        ]);
        return view('admin', compact("lista_migalhas", "usuarios", "artigos", "autores"));
    }
}
