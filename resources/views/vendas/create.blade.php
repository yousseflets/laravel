@extends('adminlte::page')

@section('title', 'Produtos - Cadastro')


@section('content')
<br/>

    <section class="content">
        <form class=" col-12 " action="{{ route('vendas.store') }}" method="post">
            @csrf
            <div class="card-body col-12" style=" border-style: 2px, solid; border-radius: 5px;box-shadow: 10px 10px 16px 10px rgb(175, 175, 175);">
                <div class="row">
                    <div class="col-4">
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
                    <div class="col-4">
                        <label for="preco">Preço</label>
                        <p><span id="preco" class="form-control" readonly>R$ 0,00</span></p>
                    </div>
                    <div class="col-4">
                        <label for="desconto">Desconto (%)</label>
                        <input type="text" class="form-control" id="desconto" name="desconto">
                    </div>
                    <div class="col-4">
                        <label for="quantidade">Quantidade</label>
                        <input type="text" class="form-control" id="quantidade" name="quantidade" required>
                    </div>
                    <div class="small-box bg-success col-md-12" style="text-align: center;">
                        <div class="inner">
                            <p><br/></p>
                            <h3 id="total">TOTAL R$ 0,00</h3>
                            <p><br/></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
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
            }
        });

        // Quando a quantidade é alterada
        $('#quantidade').on('input', function(){
            calcularTotal();
        });

        // Função para calcular o total
        function calcularTotal() {
            var quantidade = parseFloat($('#quantidade').val());

            if (quantidade > 0 && preco > 0) {
                var total = preco * quantidade;

                // Formata o total como moeda (R$)
                var totalFormatado = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                $('#total').text(totalFormatado);
            } else {
                $('#total').text('R$ 0,00');
            }
        }
    });
</script>
