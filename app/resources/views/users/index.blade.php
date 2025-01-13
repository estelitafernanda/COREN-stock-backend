@extends('layouts.app')

<<<<<<< HEAD
<h1>Lista de Produtos</h1>
=======
<h1>Lista de Usuários</h1>
>>>>>>> 7203ce1aa315dcb84ce7fe741d69c3138bd2e9ec
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Função</th>
        <tr>
    </thead>
    <tbody>
        @foreach($dados as $user)
        <tr>
            <td>{{ $user->nameUser }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('users.show', $user->idUser) }}">Ver</a>
                <a href="{{ route('users.edit', $user->idUser) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
