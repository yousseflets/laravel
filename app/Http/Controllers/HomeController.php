<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Fornecedores;
use App\Models\Categorias;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalProdutos = Produtos::count();
        $totalFornecedores = Fornecedores::count();

        return view('home', compact('totalProdutos','totalFornecedores'));
    }
}
