@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Criar Novo Usuário</h2>

        {{-- Verificando se há mensagens de sucesso ou erro --}}
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

        {{-- Formulário de criação de usuário --}}
        <form action="{{ route('users.store') }}" method="POST">
            @csrf  {{-- Garante que o formulário seja seguro contra ataques CSRF --}}
            
            <div class="form-group">
                <label for="nameUser">Nome:</label>
                <input type="text" class="form-control @error('nameUser') is-invalid @enderror" id="nameUser" name="nameUser" value="{{ old('nameUser') }}" required>
                
                {{-- Exibindo erro de validação --}}
                @error('nameUser')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha:</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Função:</label>
                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="">Selecione a função</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário</option>
                </select>
                
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="idSector">Selecione o seu Departamento</label>
                <select name="idSector" id="idSector" class="form-control" required>
                    <option value="">Selecione um setor</option>
                    @foreach($sectors as $sector)
                        <option value="{{ $sector->idSector }}" {{ old('idSector') == $sector->idSector ? 'selected' : '' }}>
                            {{ $sector->name }}
                        </option>
                    @endforeach
                </select>

                @error('idSector')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Criar Usuário</button>
            </div>
        </form>
    </div>
@endsection
