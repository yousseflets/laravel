<?php

namespace App\Http\Controllers\Fornecedores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fornecedores;

class FornecedoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fornecedores = Fornecedores::paginate(10);

        return view('fornecedores.index', compact('fornecedores'));
    }

    public function create (){
        return view('fornecedores.create');
    }

    public function store (Request $request){

        $novoFornecedor = Fornecedores::create([
            'razao_social' => $request->razao_social,
            'nome_fantasia' => $request->nome_fantasia,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'cep' => $request->cep,
            'status' => 1,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'telefone' => $request->telefone,
            'celular' => $request->celular
        ]);

        return redirect()->route('fornecedores.index')->with('success','Fornecedor criado com sucesso!!');
    }

    public function edit($id)
    {
      $fornecedores = Fornecedores::find($id);

      return view('fornecedores.edit', compact('fornecedores'));
    }


    public function update(Request $request, $id)
    {
      $fornecedores = Fornecedores::find($id);
      $fornecedores->fill($request->all());
      $fornecedores->save();

      return redirect()->route('fornecedores.index')->with('success', 'Fornecedor editado com sucesso.');
    }

    public function delete(Request $request, $id)
    {
      $fornecedores = Fornecedores::find($id);
      if($fornecedores->status == 1){
        $fornecedores = Fornecedores::where('id', '=', $fornecedores->id)->update(['status' => 0]);
      }elseif($fornecedores->status == 0){
        $fornecedores = Fornecedores::where('id', '=', $fornecedores->id)->update(['status' => 1]);
      }

      return redirect()->route('fornecedores.index')->with('success', 'Fornecedor editado com sucesso.');
    }
}
