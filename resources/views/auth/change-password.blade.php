@extends('adminlte::page')

@section('title', 'Alterar Senha')
<style>
    .content {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>

@section('content')
<br/>

    <section class="content col-6">
                <form method="POST" action="{{ route('password.change') }}">
                    @csrf
                    <div class="card-body col-12" style="border-style: 2px, solid; border-radius: 5px;box-shadow: 10px 10px 16px 10px rgb(175, 175, 175);">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="current_password">Senha Atual:</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="password">Nova Senha:</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="password_confirmation">Confirmação de Nova Senha:</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="card-body" style="text-align: right;">
                                <button type="submit" class="btn btn-success">Alterar Senha</button>
                            </div>
                        </div>
                    </div>
                </form>

    </section>
@endsection
