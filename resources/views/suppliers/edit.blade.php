@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Fornecedor</h1>

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

        <form action="{{ route('suppliers.update', $supplier->idSupplier) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="corporateReason">Razão Social</label>
                <input type="text" name="corporateReason" id="corporateReason" value="{{ old('corporateReason', $supplier->corporateReason) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $supplier->name) }}" required>
            </div>

            <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $supplier->address) }}" required>
            </div>

            <div class="form-group">
                <label for="contact">Contato</label>
                <input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact', $supplier->contact) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
