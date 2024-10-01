@extends('adminlte::page')

@section('title', 'Produtos - Cadastro')


@section('content')
<br/>

    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="card-body col-12" style=" border-style: 2px, solid; border-radius: 5px;box-shadow: 10px 10px 16px 10px rgb(175, 175, 175);">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="password_confirmation">Confirmação de Senha:</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <div class="card-body" style="text-align: right;">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-md btn-secondary">
                            Voltar
                        </a>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

