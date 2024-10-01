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
            <div class="col-lg-12" style="text-align: right;">
                <a href="{{ route('register') }}" class="btn btn-md btn-primary">
                    Cadastrar Usuário
                </a>
            </div>
            <br>
            <table class="dataTables_wrapper dt-bootstrap4 table table-bordered table-hover" id="produtos" style="background-color: #fff;">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                @forelse ($usuarios as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-transform: uppercase; text-align: center;">Nenhum usuario encontrado.</td>
                    </tr>
                @endforelse
            </table>
            <br>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <p>Mostrando {{$usuarios->count() }} de um total de {{ $usuarios->total() }}</p>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    {{ $usuarios->links('vendor.pagination.bootstrap-4') }}
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
<script src="https://cdn.jsdelivr.net/npm/jsgrid/dist/jsgrid.js"></script>

