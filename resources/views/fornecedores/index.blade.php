@extends('adminlte::page')

@section('title', 'Fornecedores')
<style>
    .mensagemBoasVindas {
        font-size: 20px;
        font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    }
</style>
@section('content_header')
    <section class="content">
        <h2 class="mensagemBoasVindas">Fornecedores</b></h2>

    </section>
@stop

@section('content')
    <div class="col-lg-12" style="text-align: right;">
        <a href="{{ route('fornecedores.create') }}" class="btn btn-md btn-primary">
            Cadastrar Fornecedor
        </a>
    </div>

    <section class="content">
        <div class="card-body" >
            <table class="table table-bordered table-hover" style="background-color: #fff;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Razão Social</th>
                        <th>Nome Fantasia</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse ($fornecedores as $f)
                    <tr style="background-color: {{$f->status == 1 ? 'lightgreen' : 'indianred' }}; color: {{$f->status == 1 ? 'black' : 'white' }} ">
                        <td>{{ $f->id }}</td>
                        <td>{{ $f->razao_social }}</td>
                        <td>{{ $f->nome_fantasia }}</td>
                        <td>{{ $f->email }}</td>
                        <td>{{ $f->status == 1 ? 'Ativo' : 'Inativo' }}</td>
                        <td>
                            <a href="{{ route('fornecedores.edit', $f->id) }}" class="btn btn-md btn-warning" {{ $f->status == 0 ? 'hidden' : '' }}>
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            @if($f->status == 1)
                                <a href="{{ route('fornecedores.delete', $f->id) }}" class="btn btn-md btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @else
                                <a href="{{ route('fornecedores.delete', $f->id) }}" class="btn btn-md btn-success">
                                    <i class="fa fa-check"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-transform: uppercase; text-align: center;">Nenhum fornecedor encontrado.</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </section>
@stop

@section('javascript')
    <script>
        $('#table_id').DataTable( {
            ajax: '/fornecedores'
        } );
    </script>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
