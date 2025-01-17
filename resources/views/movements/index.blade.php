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
            @foreach($dados as $movement)
            <tr>
                <td>{{ $movement->idMovement }}</td>
                <td>{{ $movement->idUserRequest }}</td>
                <td>{{ ucfirst($movement->movementStatus) }}</td>
                <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    {{-- Botão para visualizar --}}
                    <a href="{{ route('movements.show', $movement->idMovement) }}" class="btn btn-info btn-sm">Ver</a>

                    {{-- Botão para editar --}}
                    <a href="{{ route('movements.edit', $movement->idMovement) }}" class="btn btn-warning btn-sm">Editar</a>

                    {{-- Formulário para exclusão --}}
                    <form action="{{ route('movements.destroy', $movement->idMovement) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
