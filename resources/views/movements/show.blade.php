@extends ('layouts.app')

<h1>Detalhes do Usuário</h1>
    <p><strong>Nome:</strong> {{ $movement->idUserRequest}}</p>
    <p><strong>Categoria:</strong> {{ $movement->movementStatus }}</p>
    <p><strong>Descrição:</strong> {{ $movement->idMovement}}</p>
    <a href="{{ route('movements.index') }}">Voltar</a>
