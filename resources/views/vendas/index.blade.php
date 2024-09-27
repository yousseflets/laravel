@extends('adminlte::page')

@section('title', 'Registro de Vendas')
<style>
    .mensagemBoasVindas {
        font-size: 24px;
        font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
        align-items: center;
        justify-content: flex-end;
    }
</style>
@section('content_header')
    <section class="content">
        <h2 class="mensagemBoasVindas">Registro de Vendas</b></h2>
    </section>
@stop

@section('content')
    <div class="col-lg-12" style="text-align: right;">
        <a href="{{ route('vendas.create') }}" class="btn btn-lg btn-success">
            Registrar Venda
        </a>
    </div>

    <section class="content">
        <div class="card-body" >
            <table class="table table-bordered table-hover" style="background-color: #fff;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Produto</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse ($vendas as $v)
                    <tr style="background-color: {{$f->status == 1 ? 'lightgreen' : 'indianred' }}; color: {{$f->status == 1 ? 'black' : 'white' }} ">
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->produto->nome }}</td>
                        <td>{{ $v->quantidade }}</td>
                        <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($v->total,  2) }}</td>
                        <td>{{ \App\Helpers\DataHelper::showDateTime($v->data_venda) }}</td>
                        <td style="background-color: {{$v->status == 1 ? '#66ff66' : '#ff4d4d' }}">{{ $v->status == 1 ? 'Ativo' : 'Inativo' }}</td>
                        <td>
                            @if($v->status == 1)
                                <a href="{{ route('vendas.delete', $v->id) }}" title="Inativar" class="btn btn-md btn-danger" {{ $v->status == 0 ? 'hidden' : '' }}>
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-transform: uppercase; text-align: center;">Nenhuma venda encontrada.</td>
                    </tr>
                @endforelse
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
