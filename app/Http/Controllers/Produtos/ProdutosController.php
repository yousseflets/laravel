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

        return view('produtos.index', compact('produtos','fornecedores', 'categorias'));
    }

    public function create (){

        $produtos = Produtos::all();
        $fornecedores = Fornecedores::all();
        $categorias = Categorias::all();

        return view('produtos.create', compact('produtos','fornecedores', 'categorias'));
    }

    public function store (Request $request){

        $imagePath = null;
        // dd($request->hasFile('image'));
        if ($request->hasFile('image')) {
            // Pega o arquivo e armazena na pasta 'products'
            $imagePath = $request->file('image')->store('produtos', 'public');
            Produtos::create([
                'fornecedor_id' => $request->fornecedor_id,
                'categoria_id' => $request->categoria_id,
                'nome' => $request->nome,
                'preco' => $request->preco,
                'preco_custo' => $request->preco_custo,
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
      $produtos->fill($request->all());
      $produtos->save();

      if ($request->hasFile('image')) {
        if ($produtos->image) {
            Storage::delete('public/produtos/' . $produtos->image);
        }

        $imagePath = $request->file('image')->store('produtos', 'public');

        $produtos->image = $imagePath;
    }

    // Atualizar os outros campos
    $produtos->fornecedor_id = $request->input('fornecedor_id');
    $produtos->categoria_id = $request->input('categoria_id');
    $produtos->nome = $request->input('nome');
    $produtos->preco = $request->input('preco');
    $produtos->preco_custo = $request->input('preco_custo');
    $produtos->qtd_estoque = $request->input('qtd_estoque');

    // Salvar as mudanças no banco de dados
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

    public function exportPDF()
    {
        // Obtém todos os produtos
        $produtos = Produtos::all();

        // Carrega a view e passa os dados dos produtos
        $pdf = FacadePdf::loadView('produtos.pdf', compact('produtos'));

        // Retorna o download do arquivo PDF
        return $pdf->download('produtos.pdf');
    }
}
