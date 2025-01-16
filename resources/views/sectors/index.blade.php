@extends('layouts.app')

<h1>Lista de Setores</h1>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Chefe do Setor</th>
        <tr>
    </thead>
    <tbody>
        @foreach($sectors as $sector)
        <tr>
            <td>{{ $sector->id}}</td>
            <td>{{ $sector->name }}</td>
            <td>{{ $sector->headSector }}</td>
            <td>
                <a href="{{ route('requests.show', $sector->id) }}">Ver</a>
                <a href="{{ route('requests.edit', $sector->id) }}">Editar</a>
                <form action="{{ route('sectors.destroy', $sector->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
