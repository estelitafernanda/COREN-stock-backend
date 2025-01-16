@extends('layouts.app')

<h1>Lista de Requests</h1>
<table>
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Data</th>
            <th>Função</th>
        <tr>
    </thead>
    <tbody>
        @foreach($dados as $request)
        <tr>
            <td>{{ $request->describe }}</td>
            <td>{{ $request->quantity }}</td>
            <td>{{ $request->requestDate }}</td>
            <td>
                <a href="{{ route('requests.show', $request->idRequest) }}">Ver</a>
                <a href="{{ route('requests.edit', $request->idRequest) }}">Editar</a>
            </td>
            <td>
                <form action="{{ route('requests.destroy', $request->idRequest) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
