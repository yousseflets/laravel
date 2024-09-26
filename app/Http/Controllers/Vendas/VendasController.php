<?php

namespace App\Http\Controllers\Vendas;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\Fornecedores;
use App\Models\Produtos;
use App\Models\Vendas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendas = Vendas::all();
        $produtos = Produtos::all();

        return view('vendas.index', compact('vendas','produtos'));
    }

    public function create (){

        $produtos = Produtos::all();

        return view('vendas.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        // Encontrar o produto
        $produtos = Produtos::find($request->produto);

        // Verificar se há estoque suficiente
        if ($produtos->qtd_estoque < $request->quantidade) {
            return response()->json(['error' => 'Estoque insuficiente'], 400);
        }

        // Calcular total
        $total = $produtos->preco * $request->quantidade;
        $data =  Carbon::now()->format('Y-m-d H:i:s');

        // Registrar venda
        Vendas::create([
            'produto_id' => $produtos->id,
            'quantidade' => $request->quantidade,
            'total' => $total,
            'data_venda' => $data
        ]);

        // Atualizar estoque
        $produtos->qtd_estoque -= $request->quantidade;
        $produtos->save();
        
        return redirect()->route('vendas.index')->with('success','Venda registrada com sucesso');
        // return response()->json(['message' => 'Venda registrada com sucesso'], 201);
    }
}
