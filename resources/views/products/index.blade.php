<!-- resources/views/product/index.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>
<body>

    <h1>Lista de Produtos</h1>

    <!-- Formulário de filtro -->
    <form action="{{ route('products.index') }}" method="GET">
        <label for="category">Filtrar por Categoria:</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">Selecione uma categoria</option>
            <option value="escritorio" {{ request('category') == 'escritorio' ? 'selected' : '' }}>Escritório</option>
            <option value="alimentos" {{ request('category') == 'alimentos' ? 'selected' : '' }}>Alimentos</option>
        </select>
    </form>

    <hr>

    <!-- Exibição dos produtos -->
    <div>
        <h3>Produtos</h3>
        <ul>
            @foreach ($products as $product)
                <li>{{ $product->nameProduct }} - Categoria: {{ $product->category }} - Preço: R$ {{ number_format($product->unitPrice, 2, ',', '.') }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Paginação -->
    <div>
        {{ $products->links() }}
    </div>

</body>
</html>
