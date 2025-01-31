@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Movimentações</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Pedido (idUserRequest)</th>
                <th>Status da Movimentação</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $movement)
            <tr>
                <td>{{ $movement->idMovement }}</td>
                <td>{{ $movement->product->nameProduct ?? 'Produto não encontrado' }}</td>
                <td>{{ ucfirst($movement->movementStatus) }}</td>
                <td>{{ $movement->created_at }}</td>
                <td>
                    <!-- Formulário para enviar a requisição PATCH -->
                    <form action="{{ route('movements.update', $movement->idMovement) }}" method="POST">
                        @csrf
                        @method('PATCH') <!-- Definindo o método como PATCH -->
                        
                        <!-- Botão para enviar o formulário -->
                        <button type="submit" class="btn btn-warning">Atualizar Status</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
