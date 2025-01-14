@extends('layouts.app')

<h1>Lista de Produtos</h1>
<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Imagem</th>
        <tr>
    </thead>
    <tbody>
       
        @foreach($products as $product)
        <tr>
            <td>{{ $product->code }}</td>
            <td>{{ $product->nameProduct }}</td>
            <td>{{ $product->describe }}</td>
            <td><img src="/images/products/{{ $product->image }}" alt=""></td>
            <!-- <td>
                <a href="{{ route('products.show', $product->code) }}">Ver</a>
                <a href="{{ route('products.edit', $product->code) }}">Editar</a>
            </td> -->
        </tr>
        @endforeach
    </tbody>
</table>
