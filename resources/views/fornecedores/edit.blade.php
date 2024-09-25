@extends('adminlte::page')

@section('title', 'Fornecedores - Editar')


@section('content')
<br/>
    <section class="content">
        <form class=" col-12 " action="{{ route('fornecedores.update', $fornecedores->id) }}" method="post">
            @csrf
            <div class="card-body col-12" style=" border-style: 2px, solid; border-radius: 5px;box-shadow: 10px 10px 16px 10px rgb(175, 175, 175);">
                <div class="row">
                    <div class="col-12">
                        <label for="dados">Dados</label>
                        <br/>
                    </div>
                    <div class="col-6">
                        <label for="razaoSocial">Razão Social</label>
                        <input type="text" class="form-control" id="razao_social" name="razao_social" value="{{ $fornecedores->razao_social }}">
                    </div>
                    <div class="col-6">
                        <label for="nomeFantasia">Nome Fantasia</label>
                        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" value="{{ $fornecedores->nome_fantasia }}">
                    </div>
                    <div class="col-6 mt-2">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ $fornecedores->cnpj }}">
                    </div>
                    <div class="col-6 mt-2">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $fornecedores->email }}">
                    </div>
                    <div class="col-6 mt-2">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $fornecedores->telefone }}">
                    </div>
                    <div class="col-6 mt-2">
                        <label for="celular">Celular</label>
                        <input type="text" class="form-control" id="celular" name="celular" value="{{ $fornecedores->celular }}">
                    </div>
                    <div class="col-12">
                        <br>
                        <label for="endereco">Endereço</label>
                    </div>
                    <div class="col-3">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" value="{{ $fornecedores->cep }}">
                    </div>
                    <div class="col-9">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ $fornecedores->logradouro }}">
                    </div>
                    <div class="col-3 mt-2">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" value="{{ $fornecedores->numero }}">
                    </div>
                    <div class="col-9 mt-2">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" value="{{ $fornecedores->complemento }}">
                    </div>
                    <div class="col-5 mt-2">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $fornecedores->razao_social }}">
                    </div>
                    <div class="col-5 mt-2">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $fornecedores->cidade }}">
                    </div>
                    <div class="col-2 mt-2">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="uf" name="uf" value="{{ $fornecedores->uf }}">
                    </div>
                </div>
                <div class="card-body" style="text-align: right;">
                    <a href="{{ route('fornecedores.index') }}" class="btn btn-md btn-secondary">
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </section>
@endsection

