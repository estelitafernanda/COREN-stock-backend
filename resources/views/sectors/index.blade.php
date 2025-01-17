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
            <td>{{ $sector->idSector}}</td>
            <td>{{ $sector->name }}</td>
            <td>{{ $sector->headSector }}</td>
            <td>
                <a href="{{ route('sectors.show', $sector->idSector) }}">Ver</a>
                <a href="{{ route('sectors.edit', $sector->idSector) }}">Editar</a>
                <form action="{{ route('sectors.destroy', $sector->idSector) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
