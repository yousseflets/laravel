@extends('adminlte::page')

@section('title', 'Registro de Venda')

<style>
    /* Estilos para o dropdown customizado */
    .custom-dropdown {
        position: relative;
        display: inline-block;
        width: 250px;
    }

    .dropdown-selected {
        padding: 10px;
        border: 1px solid #ccc;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dropdown-selected img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
    }

    .dropdown-list {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        background-color: white;
        z-index: 999;
    }

    .dropdown-item {
        padding: 10px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .dropdown-item:hover {
        background-color: #f1f1f1;
    }

    .dropdown-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>

@section('content')
<br/>

    <section class="content">
        <form class=" col-12 " action="{{ route('vendas.store') }}" method="post">
            @csrf
            <div class="card-body col-12" style=" border-style: 2px, solid; border-radius: 5px;box-shadow: 10px 10px 16px 10px rgb(175, 175, 175);">
                <div class="row">
                    <div class="col-3">
                        <label for="produto">Fornecedor</label>
                        <select id="fornecedor"  name="fornecedor" class="form-control">
                            <option value="">Selecione um fornecedor</option>
                            @foreach ($suppliers as $supplier)
                                @if($supplier->status == 1)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nome_fantasia }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="produto">Produto</label>
                        <select id="produto" name="produto"  class="form-control" >
                            <option value="" >Selecione um produto</option>
                            @foreach($produtos as $produto)
                                @if($produto->status == 1)
                                    <option  value="{{ $produto->id }}">{{ $produto->nome }} - {{ $produto->categoria->nome }} - {{ $produto->qtd_estoque }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2">
                        <label for="preco">Preço</label>
                        <p><span id="preco" class="form-control" readonly>R$ 0,00</span></p>
                    </div>
                    <div class="col-2">
                        <label for="desconto">Desconto (%)</label>
                        <input type="text" class="form-control" id="desconto" name="desconto" value="0">
                    </div>
                    <div class="col-2">
                        <label for="quantidade">Quantidade</label>
                        <input type="text" class="form-control" id="quantidade" name="quantidade" required>
                    </div>
                    {{-- <div class="col-md-12 col-sm-6 col-md-6"> --}}
                        <div class="form-check m-1">
                            @foreach($metodoPagamento as $metodo)
                                {{-- <input class="form-check-input" type="radio" id="metodo_pagamento_{{ $metodo->id }}" onclick="alternarParcelados(this)" name="metodo_pagamento_id" value="{{ $metodo->id }}">
                                <label class="form-check-label" for="metodo_pagamento_{{ $metodo->id }}">{{ $metodo->descricao }}</label><br> --}}
                                <input type="radio" id="metodo_pagamento_{{ $metodo->id }}" name="metodo_pagamento" value="{{ $metodo->id }}" onclick="alternarParcelados(this)">
                                <label for="metodo_pagamento_{{ $metodo->id }}">{{ $metodo->descricao }}</label><br>
                            @endforeach
                        </div>

                    {{-- </div> --}}
                    <div class="col-md-6 col-sm-6 col-md-3" style="text-align: right;">

                    </div>
                    <div class="col-md-6 col-sm-6 col-md-3" >
                        <div class="col-3" id="parceladoOptions" style="display: none;">
                            <label for="qtd_parcelado">Parcelas</label>
                            <select id="qtd_parcelado" name="qtd_parcelado"  class="form-control">
                                <option value="1">À vista</option>
                                <option value="2">2x</option>
                                <option value="3">3x</option>
                                <option value="4">4x</option>
                                <option value="5">5x</option>
                                <option value="6">6x</option>
                                <option value="7">7x</option>
                                <option value="8">8x</option>
                                <option value="9">9x</option>
                                <option value="10">10x</option>
                            </select><br>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-md-3" style="text-align: right;">
                        <div class="info-box mb-3" style="text-align: center;">
                            <span class="info-box-icon bg-success elevation-2"><i class="fas fa-dollar-sign"> </i></span>
                            <div class="info-box-content">
                                <br/>
                                <h1 id="total" class="info-box-number">R$ 0,00</h1>
                                <span style="font-size: 9px;">Valor total da compra</span>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body" style="text-align: right;">
                    <a href="{{ route('vendas.index') }}" class="btn btn-md btn-secondary">
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-success">Registrar Venda</button>
                </div>
            </div>
        </form>
    </section>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        var preco = 0;
        // Quando o produto é alterado
        $('#produto').change(function(){
            var produtoId = $(this).val();

            if(produtoId){
                $.ajax({
                    url: '/produtos/preco/' + produtoId,
                    type: 'GET',
                    success: function(response) {
                        // Armazena o preço retornado
                        preco = parseFloat(response.preco);

                        // Formata o preço unitário
                        var precoFormatado = preco.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                        $('#preco').text(precoFormatado);

                        // Atualiza o total com base na quantidade
                        calcularTotal();
                    }
                });
            } else {
                $('#preco').text('R$ 0,00');
                $('#total').text('R$ 0,00');
                $('#desconto').text('0');
            }
        });

        // Quando a quantidade é alterada
        $('#quantidade').on('input', function(){
            calcularTotal();
        });

        // Função para calcular o total
        function calcularTotal() {
            var quantidade = parseFloat($('#quantidade').val());
            var desconto = parseFloat($('#desconto').val());

            if (quantidade > 0 && preco > 0) {
                var total = preco * quantidade;
                var valorDesconto = (total * desconto) / 100;
                var valorFinal = total - valorDesconto;

                // Formata o total como moeda (R$)
                var totalFormatado = valorFinal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                $('#total').text(totalFormatado);
            } else {
                $('#total').text('R$ 0,00');
                $('#desconto').text('0');
            }
        }
    });




        $(document).ready(function() {
            $('#fornecedor').on('change', function() {
                var fornecedorId = $(this).val();
                console.log('Fornecedor ID:', fornecedorId);

                // Limpar o select de produtos
                $('#produto').html('<option value="">Selecione um produto</option>');

                // Verifica se um fornecedor foi selecionado
                if (fornecedorId) {

                    $.ajax({
                        url: '/get-produtos/' + fornecedorId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log('Produtos recebidos:', data);
                            // Adicionar os produtos ao select
                            $.each(data, function(key, produto) {
                                $('#produto').append('<option value="' + produto.id + '" data-image="{{ asset('storage/produtos/') }}/' + produto.image + '">' + produto.nome + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Erro:', error);
                            alert('Erro ao buscar produtos');
                        }
                    });
                }
            });

            $('#produto').on('change', function() {
                var selectedProductImage = $('#produto option:selected').data('image');
                console.log('Imagem do Produto Selecionado:', selectedProductImage);

                // Exibir a imagem do produto
                if (selectedProductImage) {
                    $('#productImageDisplay').attr('src', selectedProductImage).show();
                } else {
                    $('#productImageDisplay').hide();
                }
            });
        });
          // Função para mostrar/esconder o dropdown de parcelamento
        function alternarParcelados(checkbox) {
            const installmentDiv = document.getElementById('parceladoOptions');
            // Se o checkbox do Cartão de Crédito (ID 2) for selecionado, exibe o dropdown de parcelamento
            if (checkbox.value == 2 && checkbox.checked) {
                installmentDiv.style.display = 'block';
            } else {
                installmentDiv.style.display = 'none';
            }

            // Desmarcar todos os outros checkboxes
            const checkboxes = document.querySelectorAll('input[name="metodo_pagamento"]');
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false;
            });
        }

</script>
