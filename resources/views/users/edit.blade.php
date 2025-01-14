@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Usuário</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->idUser) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nameUser" class="form-label">Nome</label>
                <input type="text" name="nameUser" id="nameUser" class="form-control" value="{{ old('nameUser', $user->nameUser) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Função</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuário</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha (deixe em branco para manter a senha atual)</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
