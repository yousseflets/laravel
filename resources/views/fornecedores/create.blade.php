@extends('adminlte::page')

@section('title', 'Fornecedores - Cadastro')


@section('content')
<br/>

    <section class="content">
        <form class=" col-12 " action="{{ route('fornecedores.store') }}" method="post">
            @csrf
            <div class="card-body col-12" style=" border-style: 2px, solid; border-radius: 5px;box-shadow: 10px 10px 16px 10px rgb(175, 175, 175);">
                <div class="row">
                    <div class="col-12">
                        <label for="dados">Dados</label>
                        <br/>
                    </div>
                    <div class="col-6">
                        <label for="razaoSocial">Razão Social</label>
                        <input type="text" class="form-control" id="razao_social" name="razao_social" required>
                    </div>
                    <div class="col-6">
                        <label for="nomeFantasia">Nome Fantasia</label>
                        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" required>
                    </div>
                    <div class="col-6 mt-2">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" required>
                    </div>
                    <div class="col-6 mt-2">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-6 mt-2">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" required>
                    </div>
                    <div class="col-6 mt-2">
                        <label for="celular">Celular</label>
                        <input type="text" class="form-control" id="celular" name="celular" required>
                    </div>
                    <div class="col-12">
                        <br>
                        <label for="endereco">Endereço</label>
                    </div>
                    <div class="col-3">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" required>
                    </div>
                    <div class="col-9">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro" name="logradouro" required>
                    </div>
                    <div class="col-3 mt-2">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>
                    <div class="col-9 mt-2">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" required>
                    </div>
                    <div class="col-5 mt-2">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" required>
                    </div>
                    <div class="col-5 mt-2">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                    </div>
                    <div class="col-2 mt-2">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="uf" name="uf" required>
                    </div>
                </div>
                <div class="card-body" style="text-align: right;">
                    <a href="{{ route('fornecedores.index') }}" class="btn btn-md btn-secondary">
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(document).ready(function(){
        $('#cep').mask('00000-000');
    });
    $(document).ready(function() {
        $('#cep').on('blur', function() {
            var cep = $(this).val().replace(/\D/g, ''); // Remove tudo que não for número

            if (cep.length === 8) {
                $.ajax({
                    url: '/cep/' + cep,
                    method: 'GET',
                    success: function(data) {
                        if (!data.error) {
                            $('#logradouro').val(data.logradouro);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.localidade);
                            $('#uf').val(data.uf);
                        }
                    },
                    error: function() {
                        alert('CEP não encontrado ou inválido.');
                    }
                });
            }
        });
    });
</script>
