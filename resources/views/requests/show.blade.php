@extends ('layouts.app')

<h1>Detalhes do Usuário</h1>
    <p><strong>Descrição:</strong> {{ $request->nameUser }}</p>
    <p><strong>Data:</strong> {{ $request->email }}</p>
    <p><strong>Quantidade:</strong> {{ $request->quantity}}</p>
    <a href="{{ route('requests.edit', $request->idRequest) }}">Editar</a>
    <a href="{{ route('requests.index') }}">Voltar</a>
