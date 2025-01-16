@extends('layouts.app')

@section('content')
    <h1>Lista de Fornecedores</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Razão Social</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Contato</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->idSupplier }}</td>
                    <td>{{ $supplier->corporateReason }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->contact }}</td>
                    <td>
                        <a href="{{ route('suppliers.show', $supplier->idSupplier) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('suppliers.edit', $supplier->idSupplier) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('suppliers.destroy', $supplier->idSupplier) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
 