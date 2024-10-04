@extends('adminlte::page')

@section('title', 'Produtos - Cadastro')


@section('content')
<br/>

    <section class="content">
        <form class=" col-12 " action="{{ route('produtos.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body col-12" style=" border-style: 2px, solid; border-radius: 5px;box-shadow: 10px 10px 16px 10px rgb(175, 175, 175);">
                <div class="row">
                    <div class="col-12">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="col-6 mt-2">
                        <label for="fornecedor_id">Fornecedor</label>
                        <select id="fornecedor_id" name="fornecedor_id" class="form-control custom-select">
                            <option selected="" disabled="">Selecione</option>
                            @foreach($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}">{{ $fornecedor->razao_social }} - CNPJ: {{ $fornecedor->cnpj }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <label for="categoria_id">Categoria</label>
                        <select id="categoria_id" name="categoria_id" class="form-control custom-select">
                            <option selected="" disabled="">Selecione</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="preco_custo">Valor Custo</label>
                        <input type="text" class="form-control" id="preco_custo" name="preco_custo" required>
                    </div>

                    <div class="col-4 mt-2">
                        <label for="preco">Preço</label>
                        <input type="text" class="form-control" id="preco" name="preco" required>
                    </div>

                    <div class="col-4 mt-2">
                        <label for="qtd_estoque">Quantidade em Estoque</label>
                        <input type="text" class="form-control" id="qtd_estoque" name="qtd_estoque" required>
                    </div>

                    <div class="col-6 mt-3">
                        <input type="file" name="image" id="image" onchange="previewImage(event)">
                    </div>

                    <div class="col-4 mt-2">
                        <img id="preview" src="" alt="Pré-visualização da Imagem" style="max-width: 300px; display: none;">
                    </div>

                </div>
                <div class="card-body" style="text-align: right;">
                    <a href="{{ route('produtos.index') }}" class="btn btn-md btn-secondary">
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </section>
@endsection
<script>
    function previewImage(event) {
        const input = event.target; // O input do tipo file
        const preview = document.getElementById('preview'); // O elemento <img> para pré-visualização

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            // Define a função que será chamada quando o FileReader terminar de carregar o arquivo
            reader.onload = function(e) {
                preview.src = e.target.result; // Define a src da imagem para o resultado do FileReader
                preview.style.display = 'block'; // Exibe a imagem (caso esteja escondida)
            }

            reader.readAsDataURL(input.files[0]); // Carrega a imagem selecionada
        } else {
            preview.src = ''; // Se não houver arquivo, remove a src
            preview.style.display = 'none'; // Esconde a imagem
        }
    }

    function formatValue() {
        var precoField = document.getElementById('preco');
        var precoCustoField = document.getElementById('preco_custo');
        // Substitui a vírgula por ponto antes de enviar o formulário
        precoField.value = precoField.value.replace(',', '.');
        precoCustoField.value = precoCustoField.value.replace(',', '.');
    }

    document.addEventListener('DOMContentLoaded', function() {
    const precoInput = document.getElementById('preco');
    const precoCustoInput = document.getElementById('preco_custo');

    // Função para substituir ponto por vírgula
    function formatarPreco(input) {
        input.addEventListener('input', function() {
            let valor = this.value.replace(/\./g, ''); // Remove pontos
            valor = valor.replace(',', '.'); // Troca vírgula por ponto
            this.value = valor.replace(/(\d+)(\d{2})$/, '$1,$2'); // Adiciona vírgula antes dos últimos dois dígitos
        });
    }

    formatarPreco(precoInput);
    formatarPreco(precoCustoInput);
});
</script>
