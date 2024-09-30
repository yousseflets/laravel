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
        /* font-size: 45px; */
        font-family:"Poppins", sans-serif;
        text-align: center;
        justify-content: center;
        color: white;
    }
    .titulo_card{
        font-size: 15px;
        font-family:"Poppins", sans-serif;
        text-align: center;
        justify-content: center;
        color: white;
        text-transform: uppercase;
    }

</style>
@section('content_header')
    <h2 class="mensagemBoasVindas"><b>Registro de vendas</b></h2>
    <h4 class="data">{{ \App\Helpers\DataHelper::showDateTime($dataHoje) }}</h4>
@stop

@section('content')

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-8"></div>
        <div class="col-lg-3 col-8"></div>
        <div class="col-lg-3 col-8"></div>
        <div class="col-lg-3 col-6 justify-content-end">
            <div class="small-box bg-indigo">
                <a href="/vendas/cadastro" class="small-box-footer">
                    <h4 style="text-transform: uppercase;">
                        Registrar Vendas &nbsp;<i class="fa fa-cart-plus"></i>
                    </h4>
                </a>
            </div>
        </div>


        <div class="col-lg-3 col-8">
            <div class="small-box bg-gradient-lightblue ">
                <div class="inner">
                    <h3>{{ $totalVendasUnidades }}</sup></h3>
                    <p class="titulo_card">Produtos vendidos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($totalVendasValor,2) }}</h3>
                    <p class="titulo_card">Valor total de vendas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3> {{ $totalProdutosEstoque }}</h3>
                    <p class="titulo_card">Estoque Atual</p>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-12">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3 class="totalLucro">R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($totalLucro,2) }}</h3>
                    <p class="titulo_card">Lucro até {{ \App\Helpers\DataHelper::showDateTime($dataHoje) }} </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>

        <div style="width: 50%; margin: auto;">
            <canvas  id="graficoPizza"></canvas>
        </div>
    </div>
</section>



@stop
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    var ctx = document.getElementById('graficoPizza').getContext('2d');
    var graficoPizza = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico de barras
            data: {
                labels: @json($usuarios), // Nomes dos usuários (do controlador)
                datasets: [{
                    label: 'Total de Vendas',
                    data: @json($quantidades), // Quantidade de vendas (do controlador)
                    backgroundColor: 'rgba(255, 0, 0, 0.2)', // Cor de fundo das barras
                    borderColor: 'rgb(255, 99, 132)', // Cor da borda das barras
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // O eixo Y começa no zero
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + ' vendas';
                            }
                        }
                    }
                }
            }
        });
</script>
@stop
