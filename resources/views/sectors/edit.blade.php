@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar setor</h1>

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

        <form action="{{ route('sectors.update', $sector->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $sector->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">head</label>
                <input type="text" name="headSector" id="email" class="form-control" value="{{ old('headSector', $sector->headSector) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('sectors.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
