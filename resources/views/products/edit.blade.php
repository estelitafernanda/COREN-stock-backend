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

        <form action="{{ route('products.update', $product->idProduct) }}" method="POST">
            @csrf
            @method('PUT')
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
                <label for="idDepartment">idDepartment:</label>
                <input type="number" class="form-control @error('email') is-invalid @enderror" id="idDepartment" name="idDepartment" value="{{ old('idDepartment') }}" required>
                
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
                <input type="date" class="form-control" id="validity" name="validity" value="{{ old('validity') }}" required>
            </div>

            <div class="form-group">
                <label for="unitPrice">unitPrice:</label>
                <input type="number" class="form-control" id="unitPrice" name="unitPrice" value="{{ old('unitPrice') }}" required>
            </div>


            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('sectors.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
