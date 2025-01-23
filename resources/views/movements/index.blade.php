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
                <td>{{ $movement->created_at }}</td>
                <td>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
