@extends ('layouts.app')

<h1>Detalhes do Usuário</h1>
    <p><strong>Nome:</strong> {{ $product->nameProduct }}</p>
    <p><strong>Categoria:</strong> {{ $product->category }}</p>
    <p><strong>Descrição:</strong> {{ $product->describe}}</p>
    <a href="{{ route('products.edit', $product->idProduct) }}">Editar</a>
    <a href="{{ route('products.index') }}">Voltar</a>
