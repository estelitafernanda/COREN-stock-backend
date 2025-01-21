@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Cadastro de Fornecedor</h4>
    </div>
    <div class="card-body">
        <!-- Exibe erros de validação, se houver -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nome do Fornecedor</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Digite o nome do fornecedor" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="telephone">Telefone</label>
                <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Digite o telefone" value="{{ old('telephone') }}" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Digite o e-mail" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="responsible">Responsável</label>
                <input type="text" name="responsible" id="responsible" class="form-control" placeholder="Digite o nome do responsável" value="{{ old('responsible') }}" required>
            </div>

            <div class="form-group">
                <label for="corporatereason">Razão Social</label>
                <input type="text" name="corporateReason" id="corporatereason" class="form-control" placeholder="Digite a razão social" value="{{ old('corporateReason') }}" required>
            </div>

            <div class="form-group">
                <label for="corporatereason">CNPJ</label>
                <input type="text" name="cnpj" id="corporatereason" class="form-control" placeholder="Digite a razão social" value="{{ old('cnpj') }}" required>
            </div>

            <div class="form-group">
                <label for="corporatereason">endereço</label>
                <input type="text" name="address" id="corporatereason" class="form-control" placeholder="Digite a razão social" value="{{ old('address') }}" required>
            </div>

            <div class="form-group">
                <label for="products">Selecione os Produtos</label>
                <select name="products[]" id="products" class="form-control" multiple required>
                    @foreach($products as $product)
                        <option value="{{ $product->idProduct }}">{{ $product->nameProduct }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Fornecedor</button>
        </form>
    </div>
</div>
@endsection
