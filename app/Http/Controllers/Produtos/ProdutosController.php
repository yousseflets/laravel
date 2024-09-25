<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Controllers\Controller;
use App\Models\Produtos;
use App\Models\Fornecedores;
use App\Models\Categorias;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produtos = Produtos::all();
        $fornecedores = Fornecedores::all();
        $categorias = Categorias::all();

        return view('produtos.index', compact('produtos','fornecedores', 'categorias'));
    }

    public function create (){

        $produtos = Produtos::all();
        $fornecedores = Fornecedores::all();
        $categorias = Categorias::all();

        return view('produtos.create', compact('produtos','fornecedores', 'categorias'));
    }

    public function store (Request $request){
        // dd($request->all());

        $novoProduto = Produtos::create([
            'fornecedor_id' => $request->fornecedor_id,
            'categoria_id' => $request->categoria_id,
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'qtd_estoque' => $request->qtd_estoque,
        ]);

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
      $produtos->fill($request->all());
      $produtos->save();

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
}
