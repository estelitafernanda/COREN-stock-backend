<h1>Lista de Produtos</h1>
<table>
    <thead>
        <tr>
            <th>Nome:</th>
            <th>Email:</th>
            <th>Função:</th>
        <tr>
    </thead>
    <tbody>
        @foreach($user as $user)
        <tr>
            <td>{{ $user->nameUser }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('users.show', $user->id) }}">Ver</a>
                <a href="{{ route('users.edit', $user->id) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
