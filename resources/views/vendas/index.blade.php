@extends('adminlte::page')

@section('title', 'Registro de Vendas')
<style>
img {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
@section('content')


    <section class="content">
        <div class="card-body" >
            <div class="col-lg-12 col-sm-6 justify-content-end" style="text-align: right;">
                <a href="{{ route('vendas.create') }}" class="btn btn-success btn-lg col-lg-3 dz-clickable">
                    Registrar Venda
                </a>
            </div>
            <br>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-2"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Vendas do dia {{ \App\Helpers\DataHelper::showDate($hoje) }}</span>
                            <span class="info-box-number">R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($totalVendasHoje,2) }} </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-2 col-md-1">

                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-2"><i class="fas fa-dollar-sign"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Lucro até {{ \App\Helpers\DataHelper::showDate($hoje) }}</span>
                            <span class="info-box-number">R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($totalLucroHoje,2) }} </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-2 col-md-1">

                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-indigo elevation-2"><i class="fa fa-cart-arrow-down"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Vendas até {{ \App\Helpers\DataHelper::showDate($hoje) }}</span>
                            <span class="info-box-number">R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($totalVendasHoje,2) }} </span>
                        </div>
                    </div>
                </div>

            </div>


            <table class="table table-bordered table-hover" style="background-color: #fff;">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Nome do Produto</th>
                        <th>Quantidade</th>
                        <th>Desconto</th>
                        <th>Total</th>
                        <th>Lucro da Venda</th>
                        <th>Data</th>
                        <th>Vendedor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse ($vendas as $v)
                    <tr style="background-color: {{$v->status == 1 ? 'lightgreen' : 'indianred' }}; color: {{$v->status == 1 ? 'black' : 'white' }} ">
                        <td>
                            @if ($v->produto->image)
                                <img src="{{ asset('storage/' . $v->produto->image) }}" alt="{{ $v->produto->name }}" style="width: 40px; height: auto;">
                            @else
                                <p>Sem imagem</p>
                            @endif
                        </td>
                        <td>{{ $v->produto->nome }}</td>
                        <td>{{ $v->quantidade }}</td>
                        <td>{{ \App\Helpers\TextoHelper::porcentagem($v->desconto , 2) ? \App\Helpers\TextoHelper::porcentagem($v->desconto , 2) : '0'}} </td>
                        <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($v->total,  2) }}</td>
                        <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($v->lucro_venda,  2)}}</td>
                        <td>{{ \App\Helpers\DataHelper::showDate($v->data_venda) }}</td>
                        <td>{{ $v->user->name }}</td>
                        <td>{{ $v->status == 1 ? 'Realizada' : 'Cancelada' }}</td>
                        <td>
                            @if($v->status == 1)
                                <a href="{{ route('vendas.cancelarVenda', $v->id) }}" {{ $v->status == 0 ? 'hidden' : '' }} title="Inativar" class="btn btn-md btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" style="text-transform: uppercase; text-align: center;">Nenhuma venda encontrada.</td>
                    </tr>
                @endforelse
            </table>
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
