@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Setor</h2>

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

        {{-- Formulário de criação de setor --}}
        <form action="{{ route('sectors.store') }}" method="POST">
            @csrf

    

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="headSector">Chefe do setor</label>
                <input type="text" name="headSector" id="headSector" class="form-control" required>
            </div>



            <button type="submit" class="btn btn-primary">Criar Setor</button>
        </form>
    </div>
@endsection
