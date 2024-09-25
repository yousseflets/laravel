@extends('adminlte::page')

@section('title', 'Dashboard')
<style>
    .mensagemBoasVindas {
        font-size: 20px;
        font-family: "Comic Sans MS", Comic Sans, cursive;
    }
</style>
@section('content_header')
    <h2 class="mensagemBoasVindas">Seja bem vindo(a) <b>{{ auth()->user()->name }}</b></h2>
@stop

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
        <div class="col-lg-4 col-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h3>0</h3>
                <p>Clientes</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
                <a href="#" class="small-box-footer">Acesse <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalFornecedores }}</h3>
                    <p>Fornecedores</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('fornecedores.index') }}" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalProdutos }}</h3>
                        <p>Produtos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('produtos.index') }}" class="small-box-footer">Acesse <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

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
