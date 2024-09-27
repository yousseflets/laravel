@extends('adminlte::page')

@section('title', 'Produtos')
<style>
    .mensagemBoasVindas {
        font-size: 26px;
        font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    }
</style>
@section('content_header')
<div class="container">

    <section class="content">
        <h2 class="mensagemBoasVindas">Produtos</b></h2>

    </section>
</div>
@stop

@section('content')

    <section class="content">
        <div class="card-body" >
            <div class="col-lg-12" style="text-align: right;">
                <a href="{{ route('produtos.create') }}" class="btn btn-md btn-primary">
                    Cadastrar Produtos
                </a>
            </div>
            <br>
            <table class="dataTables_wrapper dt-bootstrap4 table table-bordered table-hover" id="produtos" style="background-color: #fff;">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome do Produto</th>
                        <th>Fornecedor</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Quantidade em Estoque</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse ($produtos as $p)
                    <tr style="margin-bottom: 100px;background-color: {{$p->status == 1 ? 'lightgreen' : 'indianred' }}; color: {{$p->status == 1 ? 'black' : 'white' }} ">
                        <td>
                            @if ($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" style="width: 50px; height: auto;">
                            @else
                                <p>Sem imagem</p>
                            @endif
                        </td>
                        <td class="centralizado">{{ $p->nome }}</td>
                        <td>{{ $p->fornecedor->razao_social }}</td>
                        <td>{{ $p->categoria->nome }}</td>
                        <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($p->preco,  2) }}</td>
                        <td> {{ $p->qtd_estoque }} unidades</td>
                        <td>{{ $p->status == 1 ? 'Ativo' : 'Inativo' }}</td>
                        <td>
                            <a href="{{ route('produtos.edit', $p->id) }}" title="Editar" class="btn btn-md btn-warning" {{ $p->status == 0 ? 'hidden' : '' }}>
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            @if($p->status == 1)
                                <a href="{{ route('produtos.delete', $p->id) }}" title="Inativar" class="btn btn-md btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @else
                                <a href="{{ route('produtos.delete', $p->id) }}" title="Ativar" class="btn btn-md btn-success">
                                    <i class="fa fa-check"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-transform: uppercase; text-align: center;">Nenhum produto encontrado.</td>
                    </tr>
                @endforelse
            </table>
            <br>
            <div class="d-flex justify-content-end">
                {{ $produtos->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>

    </section>
@stop
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsgrid/dist/jsgrid.js"></script>

