@extends ('layouts.app')

<h1>Detalhes do Usuário</h1>
    <p><strong>Nome do Usuário:</strong> {{ $movement->idUserRequest}}</p>
    <p><strong>Status:</strong> {{ $movement->movementStatus }}</p>
    <p><strong>idMovement:</strong> {{ $movement->idMovement}}</p>
    <a href="{{ route('movements.index') }}">Voltar</a>
