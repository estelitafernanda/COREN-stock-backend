@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Pedido</h2>

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

        {{-- Formulário de criação de pedido --}}
        <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data">
            @csrf  {{-- Garante que o formulário seja seguro contra ataques CSRF --}}
            
            <div class="form-group">
                <label for="describe">Descrição</label>
                <input type="text" class="form-control" id="describe" name="describe" value="{{ old('describe') }}" required>
                
            </div>

            <div class="form-group">
                <label for="date">Data</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('requestDate') }}" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantidade:</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Criar Pedido</button>
            </div>
        </form>
    </div>
@endsection
