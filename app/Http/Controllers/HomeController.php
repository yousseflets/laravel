<?php

namespace App\Http\Controllers;

use App\Models\Vendas;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Fornecedores;
use App\Models\Categorias;
use Carbon\Carbon;

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
        $totalVendas = Vendas::count();
        $dataHoje = Carbon::now()->format('Y-m-d H:i:s');


        return view('home', compact('totalProdutos','totalFornecedores', 'totalVendas','dataHoje'));
    }
}
