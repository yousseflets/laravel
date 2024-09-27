<?php

namespace App\Http\Controllers;

use App\Models\Vendas;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Fornecedores;
use App\Models\Categorias;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $totalProdutosEstoque = Produtos::sum('qtd_estoque');
        $totalVendasUnidades = Vendas::whereDate('data_venda', '<=', now())->sum('quantidade');
        $dataHoje = Carbon::now()->format('Y-m-d H:i:s');

        $totalPorDia = Vendas::select(DB::raw('DATE(data_venda) as date'), DB::raw('SUM(total) as total'),
        DB::raw('SUM(quantidade) as quantidade'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $totalVendasValor = Vendas::whereDate('data_venda', '<=', now())->sum('total');

        return view('home', compact('totalProdutosEstoque', 'totalVendasUnidades','totalVendasValor','dataHoje', 'totalPorDia'));
    }
}
