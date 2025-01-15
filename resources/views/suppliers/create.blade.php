@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Criar Fornecedor</h2>

        {{-- Verificando mensagens de sucesso ou erro --}}
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

        {{-- Formulário de criação de fornecedor --}}
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="idSupplier">ID do Fornecedor</label>
                <input type="number" name="idSupplier" id="idSupplier" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="corporateReason">Razão Social</label>
                <input type="text" name="corporateReason" id="corporateReason" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="contact">Contato</label>
                <input type="text" name="contact" id="contact" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Criar Fornecedor</button>
        </form>
    </div>
@endsection
