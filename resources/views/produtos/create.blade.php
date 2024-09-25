@extends('adminlte::page')

@section('title', 'Produtos - Cadastro')


@section('content')
<br/>

    <section class="content">
        <form class=" col-12 " action="{{ route('produtos.store') }}" method="post">
            @csrf
            <div class="card-body col-12" style=" border-style: 2px, solid; border-radius: 5px;box-shadow: 10px 10px 16px 10px rgb(175, 175, 175);">
                <div class="row">
                    <div class="col-12">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="col-3">
                        <label for="fornecedor_id">Fornecedor</label>
                        <select id="fornecedor_id" name="fornecedor_id" class="form-control custom-select">
                            <option selected="" disabled="">Selecione</option>
                            @foreach($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}">{{ $fornecedor->razao_social }} - CNPJ: {{ $fornecedor->cnpj }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="categoria_id">Categoria</label>
                        <select id="categoria_id" name="categoria_id" class="form-control custom-select">
                            <option selected="" disabled="">Selecione</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="preco">Preço</label>
                        <input type="text" class="form-control" id="preco" name="preco" required>
                    </div>
                    <div class="col-3">
                        <label for="qtd_estoque">Quantidade em Estoque</label>
                        <input type="text" class="form-control" id="qtd_estoque" name="qtd_estoque" required>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="card-body" style="text-align: right;">
                    <a href="{{ route('produtos.index') }}" class="btn btn-md btn-secondary">
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </section>
@endsection

