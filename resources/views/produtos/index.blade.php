@extends('adminlte::page')

@section('title', 'Produtos')
<style>
    .mensagemBoasVindas {
        font-size: 20px;
        font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    }
</style>
@section('content_header')
    <section class="content">
        <h2 class="mensagemBoasVindas">Produtos</b></h2>

    </section>
@stop

@section('content')
    <div class="col-lg-12" style="text-align: right;">
        <a href="{{ route('produtos.create') }}" class="btn btn-md btn-primary">
            Cadastrar
        </a>
    </div>

    <section class="content">
        <div class="card-body" >
            <table class="table table-bordered table-hover" style="background-color: #fff;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Produto</th>
                        <th>Fornecedor</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Quantidade em Estoque</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach ($produtos as $p)
                    <tbody style="background-color: {{$p->status == 1 ? '#66ff66' : '#ff4d4d' }}; color: {{$p->status == 1 ? 'black' : 'white' }} ">
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->nome }}</td>
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
                    </tbody>
                @endforeach
            </table>
        </div>
    </section>
@stop

@section('javascript')
    <script>
        $('#table_id').DataTable( {
            ajax: '/produtos'
        } );
    </script>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
