@extends('adminlte::page')

@section('title', 'Histórico')
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
        <h2 class="mensagemBoasVindas">Histórico de Vendas</b></h2>
    </section>
@stop

@section('content')
    <section class="content">
        <div class="card-body" >
            <form action="{{ route('historico.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-5">
                        <label for="start_date">Data Inicial</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-5">
                        <label for="end_date">Data Final</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-hover" style="background-color: #fff;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vendedor</th>
                        <th>Nome do Produto</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Data</th>
                    </tr>
                </thead>
                @forelse ($historico as $h)
                    <tr>
                        <td>{{ $h->id }}</td>
                        <td>{{ $h->user->name }}</td>
                        <td>{{ $h->produto->nome }}</td>
                        <td>{{ $h->venda->quantidade }}</td>
                        <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($h->venda->total,  2) }}</td>
                        <td>{{ \App\Helpers\DataHelper::showDate($h->venda->data_venda) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-transform: uppercase; text-align: center;">Nenhuma venda registrada.</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </section>
@stop


@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
