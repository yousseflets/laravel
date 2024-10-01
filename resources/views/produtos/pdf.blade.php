<!-- resources/views/products/pdf.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Lista de Produtos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço Custo</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->categoria->nome }}</td>
                    <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($produto->preco_custo,  2) }}</td>
                    <td>R$ {{ \App\Helpers\TextoHelper::numeroComVirgula($produto->preco,  2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
