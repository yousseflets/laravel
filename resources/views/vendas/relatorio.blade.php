@extends('adminlte::page')

@section('title', 'Relatório de Vendas')
<style>
img {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
@section('content')


    <section class="content">
        <div class="card-body">
            <form action="{{ route('vendas.relatorio') }}" method="GET" style="background-color: #fff;" >
                <div class="card-body col-12" style=" border-style: 2px, solid; border-radius: 5px  ;">
                    <div class="row">
                        <div class="col-6">
                            <label  for="data_inicial">Data Inicial</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input class="form-control" type="date" name="data_inicial" id="data_inicial" value="{{ request('data_inicial') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="data_final">Data Final</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input class="form-control"  type="date" name="data_final" id="data_final" value="{{ request('data_final') }}">
                            </div>
                        </div>
                        <div class="card-body" style="text-align: right;">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
                        </div>
                    </div>

                </div>
            </form>

                <table class="table table-bordered table-hover" style="background-color: #fff;">

                    <thead>
                        <tr>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Quantidade</th>
                                    <th>Preço Lucro</th>
                                    <th>Preço Venda</th>
                                    <th>Estoque Atual</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                        </tr>
                    </thead>
                    @if($filtroRelatorio->isEmpty())
                        <td colspan="7" style="text-transform: uppercase; text-align: center;">Nenhuma venda encontrada no período selecionado.</td>
                    @else
                        @foreach ($vendas as $venda)
                            <tr>
                                <td>{{ $venda->id }}</td>
                                <td>{{ $venda->produto->nome }}</td>
                                <td>{{ $venda->produto->categoria->nome }}</td>
                                <td>{{ $venda->quantidade }}</td>
                                <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($venda->lucro_venda,  2) }}</td>
                                <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($venda->total,  2) }}</td>
                                <td>{{ $venda->produto->qtd_estoque }} unidades</td>
                                <td>{{ \App\Helpers\DataHelper::showDate($venda->data_venda) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
                <div class="col-sm-12 d-flex justify-content-end">
                    <div class="table-responsive" >
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:63%; color: red; font-size: 18px"></th>
                                    <td style="color: green; font-size: 18px"><b>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($totalVendas,  2) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <br>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <p>Mostrando <b>{{$vendas->count() }}</b> de um total de <b>{{ $vendas->total() }}</b> vendas</p>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    {{ $vendas->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
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
