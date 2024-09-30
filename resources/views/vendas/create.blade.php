@extends('adminlte::page')

@section('title', 'Registro de Venda')


@section('content')
<br/>

    <section class="content">
        <form class=" col-12 " action="{{ route('vendas.store') }}" method="post">
            @csrf
            <div class="card-body col-12" style=" border-style: 2px, solid; border-radius: 5px;box-shadow: 10px 10px 16px 10px rgb(175, 175, 175);">
                <div class="row">
                    <div class="col-3">
                        <label for="preco">Produto</label>
                        <select id="produto" name="produto"  class="form-control">
                            <option value="">Selecione um produto</option>
                            @foreach($produtos as $produto)
                                @if($produto->status == 1)
                                    <option value="{{ $produto->id }}">{{ $produto->nome }} - {{ $produto->categoria->nome }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="preco">Preço</label>
                        <p><span id="preco" class="form-control" readonly>R$ 0,00</span></p>
                    </div>
                    <div class="col-3">
                        <label for="desconto">Desconto (%)<small style="color:red;"> Vendas sem desconto digitar 0</small></label>
                        <input type="text" class="form-control" id="desconto" name="desconto" value="0">
                    </div>
                    <div class="col-3">
                        <label for="quantidade">Quantidade</label>
                        <input type="text" class="form-control" id="quantidade" name="quantidade" required>
                    </div>

                    <div class="col-md-12 col-sm-6 col-md-3">
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
</script>
