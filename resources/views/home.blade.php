@extends('adminlte::page')

@section('title', 'Dashboard')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<style>

    .mensagemBoasVindas {
        font-family: "Poppins", sans-serif;
        font-size: 48px;
        text-align: center;
        justify-content: center;
        text-transform: uppercase;
    }
    .data {
        font-size: 15px;
        font-family: "Lucida Console", "Courier New", monospace;
        text-align: center;
        justify-content: center;
    }
    .inner {
        font-size: 15px;
        font-family: "Lucida Console", "Courier New", monospace;
        text-align: center;
        justify-content: center;
        color: white;
    }
</style>
@section('content_header')
    <h2 class="mensagemBoasVindas">Seja bem vindo ao sistema de <br><b>Registro de vendas</b></h2>
    <h4 class="data">{{ \App\Helpers\DataHelper::showDateTime($dataHoje) }}</h4>
@stop

@section('content')

<section class="content">
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $totalVendas }}</sup></h3>
                    <p>Vendas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/vendas" class="small-box-footer">Acesse <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ $totalFornecedores }}</h3>
                    <p>Fornecedores</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/fornecedores" class="small-box-footer">Acesse <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{ $totalProdutos }}</h3>
                    <p>Produtos</p>
                </div>
                <a href="/produtos" class="small-box-footer">Acesse <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p>Pensar em o q por aqui</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
    </div>
</section>




@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
