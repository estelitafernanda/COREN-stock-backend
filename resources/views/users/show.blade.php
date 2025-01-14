@extends ('layouts.app')

<h1>Detalhes do Usuário</h1>
    <p><strong>Nome:</strong> {{ $user->nameUser }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Função:</strong> {{ $user->role }}</p>
    <a href="{{ route('users.edit', $user->idUser) }}">Editar</a>
    <a href="{{ route('users.index') }}">Voltar</a>
