<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Controllers\Controller;
use App\Models\Produtos;
use App\Models\Fornecedores;
use App\Models\Categorias;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produtos = Produtos::paginate(5);
        $fornecedores = Fornecedores::all();
        $categorias = Categorias::all();
        $produtosEsgotando = Produtos::whereColumn('qtd_estoque', '<=', 'alerta_estoque')->get();


        return view('produtos.index', compact('produtos','fornecedores', 'categorias', 'produtosEsgotando'));
    }

    public function create (){

        $produtos = Produtos::all();
        $fornecedores = Fornecedores::all();
        $categorias = Categorias::all();

        return view('produtos.create', compact('produtos','fornecedores', 'categorias'));
    }

    public function store (Request $request){

        $imagePath = null;
        $preco = str_replace(',', '.', str_replace('.', '', $request->input('preco')));
        $precoCusto = str_replace(',', '.', str_replace('.', '', $request->input('preco_custo')));
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produtos', 'public');
            Produtos::create([
                'fornecedor_id' => $request->fornecedor_id,
                'categoria_id' => $request->categoria_id,
                'nome' => $request->nome,
                'preco' => $preco,
                'preco_custo' => $precoCusto,
                'image' => $imagePath,
                'qtd_estoque' => $request->qtd_estoque,
            ]);
        }



        return redirect()->route('produtos.index')->with('success','Produto criado com sucesso!!');
    }

    public function edit($id)
    {
      $produtos = Produtos::find($id);
      $fornecedores = Fornecedores::all();
      $categorias = Categorias::all();

      return view('produtos.edit', compact('produtos','fornecedores', 'categorias'));
    }


    public function update(Request $request, $id)
    {
      $produtos = Produtos::find($id);

      if ($request->hasFile('image')) {
        if ($produtos->image) {
            Storage::delete('public/produtos/' . $produtos->image);
        }

        $imagePath = $request->file('image')->store('produtos', 'public');

        $produtos->image = $imagePath;
    }

    $preco = str_replace(',', '.', trim($request->input('preco')));
    $precoCusto = str_replace(',', '.', trim($request->input('preco_custo')));

    $produtos->update([
        'fornecedor_id' => $request->input('fornecedor_id'),
        'categoria_id' => $request->input('categoria_id'),
        'nome' => $request->input('nome'),
        'preco' => $preco,
        'preco_custo' => $precoCusto,
        'qtd_estoque' => $request->input('qtd_estoque'),
    ]);


      return redirect()->route('produtos.index')->with('success', 'Produto editado com sucesso.');
    }

    public function delete(Request $request, $id)
    {
      $produtos = Produtos::find($id);
      if($produtos->status == 1){
        $produtos = Produtos::where('id', '=', $produtos->id)->update(['status' => 0]);
      }elseif($produtos->status == 0){
        $produtos = Produtos::where('id', '=', $produtos->id)->update(['status' => 1]);
      }

      return redirect()->route('produtos.index')->with('success', 'Produto inativado com sucesso.');
    }

    public function getPreco($id)
    {
        $produto = Produtos::find($id);
        return response()->json(['preco' => $produto->preco]);
    }

    public function exportPDF()
    {
        $produtos = Produtos::all();

        $pdf = FacadePdf::loadView('produtos.pdf', compact('produtos'));

        return $pdf->download('produtos.pdf');
    }

    public function getProductsBySupplier($fornecedorId)
    {
        $produtos = Produtos::where('fornecedor_id', $fornecedorId)->get();

        return response()->json($produtos);
    }
}
