@extends('adminlte::page')

@section('title', 'Produtos')
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
        <a href="{{ route('vendas.create') }}" class="btn btn-lg btn-primary">
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
                    </tr>
                </thead>
                @foreach ($vendas as $v)
                {{-- {{ dd($v) }} --}}
                    <tbody style="background-color: {{$v->status == 1 ? '#66ff66' : '#ff4d4d' }}; color: {{$v->status == 1 ? 'black' : 'white' }} ">
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->produto->nome }}</td>
                        <td>{{ $v->quantidade }}</td>
                        <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($v->total,  2) }}</td>
                        <td>{{ \App\Helpers\DataHelper::showDateTime($v->data_venda) }}</td>
                        <td style="background-color: {{$v->status == 1 ? '#66ff66' : '#ff4d4d' }}">{{ $v->status == 1 ? 'Ativo' : 'Inativo' }}</td>
                        {{-- <td> --}}
                            {{-- <a href="{{ route('vendas.edit', $v->id) }}" title="Editar" class="btn btn-md btn-warning" {{ $v->status == 0 ? 'hidden' : '' }}>
                                <i class="fas fa-pencil-alt"></i>
                            </a> --}}
                            {{-- @if($v->status == 1)
                                <a href="{{ route('vendas.delete', $v->id) }}" title="Inativar" class="btn btn-md btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @else
                                <a href="{{ route('vendas.delete', $v->id) }}" title="Ativar" class="btn btn-md btn-success">
                                    <i class="fa fa-check"></i>
                                </a>
                            @endif --}}
                        {{-- </td> --}}
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
