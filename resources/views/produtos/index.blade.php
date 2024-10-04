@extends('adminlte::page')

@section('title', 'Produtos')
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
            @if($produtosEsgotando->isNotEmpty())
                <!-- Modal -->
                <div class="modal fade" id="alertaEstoqueBaixoModal" style="" tabindex="-1" aria-labelledby="alertaEstoqueBaixoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content ">
                            <div class="modal-header"  style="background-color: red; color:white; text-transform: uppercase; text-align: center; justify-content: center">
                                <h5 class="modal-title" id="alertaEstoqueBaixoLabel">Alerta de Estoque Baixo</h5>
                            </div>
                            <div class="modal-body">
                                <ul>
                                    @foreach($produtosEsgotando as $produto)
                                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> {{ $produto->nome }} - Tem somente <b>{{ $produto->qtd_estoque }}</b> un restante(s)<br>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($produtosEsgotando->isNotEmpty())
                <!-- Modal -->
                <div class="modal fade" id="alertaEstoqueBaixoModal" tabindex="-1" aria-labelledby="alertaEstoqueBaixoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="alertaEstoqueBaixoLabel">Alerta: Produtos com Estoque Baixo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Os seguintes produtos estão com o estoque baixo:</p>
                                <ul>
                                    @foreach($produtosEsgotando as $produto)
                                        <li>{{ $produto->nome }} - Apenas {{ $produto->qtd_estoque }} unidade(s) restante(s)</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="closeModalBtn">Fechar via JavaScript</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-12" style="text-align: right;">
                <a href="{{ route('produtos.create') }}" class="btn btn-md btn-primary">
                    Cadastrar Produtos
                </a>
                <a href="{{ route('produtos.export_pdf') }}" class="btn btn-lg btn-warning" title="Download lista de produtos">
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>
                @if($produtosEsgotando->isNotEmpty())
                    <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal" title="Baixo Estoque" data-bs-target="#alertaEstoqueBaixoModal">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                    </button>
                @endif
            </div>

            <br>
            <table class="dataTables_wrapper dt-bootstrap4 table table-bordered table-hover" id="produtos" style="background-color: #fff;">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Nome do Produto</th>
                        <th>Fornecedor</th>
                        <th>Categoria</th>
                        <th>Preço Custo</th>
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
                        <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($p->preco_custo,  2) }}</td>
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <p>Mostrando {{$produtos->count() }} de um total de {{ $produtos->total() }}.</p>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    {{ $produtos->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>

        </div>
        {{-- <div class="content-header">
            <div class="container-fluid"> --}}

            {{-- </div>
            </div> --}}



    </section>
@stop
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


@if($produtosEsgotando->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alertaEstoqueBaixoModal = new bootstrap.Modal(document.getElementById('alertaEstoqueBaixoModal'));
            alertaEstoqueBaixoModal.show();

        });
    </script>
@endif
