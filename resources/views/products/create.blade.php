@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Criar Novo Produto</h2>

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
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf  {{-- Garante que o formulário seja seguro contra ataques CSRF --}}
            
            <div class="form-group">
                <label for="nameUser">Nome:</label>
                <input type="text" class="form-control" id="nameProduct" name="nameProduct" value="{{ old('nameProduct') }}" required>
                
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}" required>
            </div>

            <div class="form-group">
                <label for="category">category:</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
                
            </div>

            <div class="form-group">
                <label for="code">code:</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" required>

            </div>

            <div class="form-group">
                <label for="idSector">Departamento:</label>
                <input type="number" class="form-control @error('email') is-invalid @enderror" id="idSector" name="idSector" value="{{ old('idSector') }}" required>
                
            </div>

            <div class="form-group">
                <label for="describe">describe:</label>
                <input type="textarea" class="form-control" id="describe" name="describe" value="{{ old('describe') }}" required>
            </div>

            <div class="form-group">
                <label for="minQuantity">minQuantity:</label>
                <input type="number" class="form-control" id="minQuantity" name="minQuantity" value="{{ old('minQuantity') }}" required>
            </div>

            <div class="form-group">
                <label for="currentQuantity">currentQuantity:</label>
                <input type="number" class="form-control" id="currentQuantity" name="currentQuantity" value="{{ old('currentQuantity') }}" required>
            </div>

            <div class="form-group">
                <label for="location">location:</label>
                <input type="textarea" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
            </div>



            <div class="form-group">
                <label for="validity">validity:</label>
                <input type="date" class="form-control" id="validity" name="validity" value="{{ old('validity') }}">
            </div>

            <div class="form-group">
                <label for="unitPrice">unitPrice:</label>
                <input type="number" class="form-control" id="unitPrice" name="unitPrice" value="{{ old('unitPrice') }}" required>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">adicionar produto</button>
            </div>
        </form>
    </div>
@endsection