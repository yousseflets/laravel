<?php

namespace App\Http\Controllers\Vendas;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\Fornecedores;
use App\Models\Historico;
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

        $desconto = $request->input('desconto', 0);

        if ($desconto > 0) {
            $valorFinal = $total - ($total * ($desconto / 100));
        } else {
            $valorFinal = $total;
        }

        // Registrar venda
        $vendas = Vendas::create([
            'produto_id' => $produtos->id,
            'quantidade' => $request->quantidade,
            'total' => $valorFinal,
            'data_venda' => $data,
            'desconto' => $desconto
        ]);

        $vendas->save();

        Historico::create([
            'user_id' => auth()->user()->id,
            'produto_id' => $produtos->id,
            'venda_id' => $vendas->id
        ]);

        // Atualizar estoque
        if($vendas->status == 1){
            $produtos->qtd_estoque -= $request->quantidade;
            $produtos->save();
        }


        return redirect()->route('vendas.index')->with('success','Venda registrada com sucesso');
    }

    public function vendaCancelada($id)
    {
        $vendas = Vendas::findOrFail($id);

        if ($vendas->status !== 0) {
            $vendas->vendaCancelada();

            return response()->json(['message' => 'Venda cancelada e estoque atualizado!']);
        }

        return response()->json(['message' => 'A venda já está cancelada!'], 400);
    }
}
