<?php

namespace App\Http\Controllers\Vendas;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\Fornecedores;
use App\Models\Produtos;
use App\Models\Vendas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendas = Vendas::paginate(5);
        $produtos = Produtos::all();

        $hoje = Carbon::today();
        $vendasHoje = Vendas::whereDate('data_venda', $hoje)->where('status', 1)->get();
        $totalVendas = $vendasHoje->sum('total');

        $totalVendasHoje = Vendas::where('data_venda', '<=', Carbon::now())->where('status', 1)->sum('total');
        $totalLucroHoje = Vendas::where('data_venda', '<=', Carbon::now())->where('status', 1)->sum('lucro_venda');


        return view('vendas.index', compact('vendas','produtos', 'totalVendas', 'hoje', 'totalVendasHoje', 'totalLucroHoje'));
    }

    public function create (){

        $produtos = Produtos::all();
        $suppliers = Fornecedores::all();

        return view('vendas.create', compact('produtos', 'suppliers'));
    }

    public function store(Request $request)
    {
        $produtos = Produtos::find($request->produto);

        if ($produtos->qtd_estoque < $request->quantidade) {
            return response()->json(['error' => 'Estoque insuficiente'], 400);
        }

        $total = $produtos->preco * $request->quantidade;

        $data =  Carbon::now()->format('Y-m-d H:i:s');


        $desconto = $request->input('desconto', 0);

        if ($desconto > 0) {
            $valorFinal = $total - ($total * ($desconto / 100));
        } else {
            $valorFinal = $total;
        }

        $vendas = Vendas::create([
            'produto_id' => $produtos->id,
            'quantidade' => $request->quantidade,
            'total' => $valorFinal,
            'lucro_venda' =>  $valorFinal - ($request->quantidade * $produtos->preco_custo),
            'data_venda' => $data,
            'desconto' => $desconto,
            'user_id' => auth()->user()->id,
        ]);

        $vendas->save();

        $produtos->qtd_estoque -= $request->quantidade;
        $produtos->save();


        return redirect()->route('vendas.index')->with('success','Venda registrada com sucesso');
    }

    public function cancelarVenda($id)
    {
        // Encontrar a venda pelo ID
        $venda = Vendas::findOrFail($id);

        // Encontrar o produto relacionado à venda
        $produto = Produtos::findOrFail($venda->produto_id);

        // Atualizar o estoque do produto, somando a quantidade vendida de volta ao estoque
        $produto->qtd_estoque += $venda->quantidade;
        $produto->save();

        // Agora, remover a venda ou marcar como cancelada (excluir no exemplo)
        if($venda->status == 1){
            $produtos = Vendas::where('id', '=', $venda->id)->update(['status' => 0]);
        }elseif($venda->status == 0){
            $venda = Vendas::where('id', '=', $venda->id)->update(['status' => 1]);
        }


        // Redirecionar ou retornar uma resposta
        return redirect()->route('vendas.index')->with( 'Venda cancelada e estoque atualizado.');
    }

    public function relatorio(Request $request)
    {
        $vendas = Vendas::paginate(5);
        $produtos = Produtos::all();

        // Captura os parâmetros de data
        $data_inicial = $request->input('data_inicial');
        $data_final = $request->input('data_final');
        // dd($data_inicial, $data_final);

        // Cria a query inicial
        $filtroRelatorio = Vendas::query();

        if ($data_inicial && $data_final) {
            // Usa o Query Builder para construir a query SQL
            $filtroRelatorio = Vendas::whereDate('data_venda', '>=', $data_inicial)
                ->whereDate('data_venda', '<=', $data_final)
                ->get(); // Você pode usar paginate se quiser paginar os resultados

        } else {
            // Se nenhuma data for fornecida, retorna todas as vendas
            $filtroRelatorio = Vendas::get();
        }

        $totalVendas = $filtroRelatorio->sum('total');


        return view('vendas.relatorio', compact('vendas','produtos', 'filtroRelatorio', 'totalVendas'));
    }
}
