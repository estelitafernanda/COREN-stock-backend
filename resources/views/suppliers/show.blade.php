@extends ('layouts.app')

<h1>Detalhes do Fornecedor</h1>
    <p><strong>Nome:</strong> {{ $supplier->name }}</p>
    <p><strong>razão social:</strong> {{ $supplier->corporateReason }}</p>
    <p><strong>endereço:</strong> {{ $supplier->adress }}</p>
    <a href="{{ route('suppliers.edit', $supplier->idSupplier) }}">Editar</a>
    <a href="{{ route('suppliers.index') }}">Voltar</a>
