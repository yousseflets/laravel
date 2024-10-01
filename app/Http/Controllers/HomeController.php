<?php

namespace App\Http\Controllers;

use App\Models\Vendas;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Fornecedores;
use App\Models\Categorias;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;

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
        $totalProdutosEstoque = Produtos::where('status', 1)->sum('qtd_estoque');
        $totalVendasUnidades = Vendas::whereDate('data_venda', '<=', now())->where('status', 1)->sum('quantidade');
        $dataHoje = Carbon::now()->format('Y-m-d H:i:s');
        $totalLucro = Vendas::where('status', 1)->sum('lucro_venda');
        $totalVendasValor = Vendas::whereDate('data_venda', '<=', now())->where('status', 1)->sum('total');
        $totalPorDia = Vendas::select(DB::raw('DATE(data_venda) as date'), DB::raw('SUM(total) as total'),
        DB::raw('SUM(quantidade) as quantidade'))
            ->where('status', 1)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $vendas = User::withSum(['vendas' => function ($query) {
            $query->where('status', 1);
        }], 'quantidade')
            ->orderByDesc('vendas_sum_quantidade')
            ->get(['name', 'vendas_sum_quantidade']);

        $usuarios = $vendas->pluck('name')->toArray();
        $quantidades = $vendas->pluck('vendas_sum_quantidade')->toArray();


        $vendasPorCategoria = Vendas::selectRaw('categorias.nome as categoria, SUM(vendas.quantidade) as total_vendido')
        ->join('produtos', 'produtos.id', '=', 'vendas.produto_id')
        ->join('categorias', 'categorias.id', '=', 'produtos.categoria_id')
        ->groupBy('categorias.nome')
        ->get();

        // Criar o gráfico
        $categorias = $vendasPorCategoria->pluck('categoria')->toArray();
        $valores = $vendasPorCategoria->pluck('total_vendido')->toArray();


        return view('home',
            compact(
                'totalLucro',
                'totalProdutosEstoque',
                'totalVendasUnidades',
                'totalVendasValor',
                'dataHoje',
                'totalPorDia',
                'usuarios',
                'quantidades',
                'categorias',
                'valores'
            )
        );
    }
}
