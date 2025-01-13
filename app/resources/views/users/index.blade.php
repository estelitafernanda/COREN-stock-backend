@extends('layouts.app')

<h1>Lista de Usuários</h1>
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
