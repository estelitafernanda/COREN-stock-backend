@extends ('layouts.app')

<h1>Detalhes do Usuário</h1>
    <p><strong>Descrição:</strong> {{ $sector->name }}</p>
    <p><strong>Data:</strong> {{ $sector->headSector }}</p>
    <p><strong>Quantidade:</strong> {{ $sector->idSector}}</p>
    <a href="{{ route('sectors.edit', $sector->idSector) }}">Editar</a>
    <a href="{{ route('sectors.index') }}">Voltar</a>
