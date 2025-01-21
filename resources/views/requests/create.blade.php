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
        <form action="{{ route('requests.store') }}" method="POST">
            @csrf

            <!-- Campo para selecionar o produto -->
            <div class="form-group">
                <label for="idProduct">Produto</label>
                <select name="idProduct" id="idProduct" class="form-control" required>
                    <option value="">Selecione o produto</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->idProduct }}">{{ $product->nameProduct }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idUser">Usuário</label>
                <select name="idUser" id="idUser" class="form-control" required>
                    <option value="">Selecione o usuário</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->idUser }}">{{ $user->nameUser }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="describe">Descrição</label>
                <input type="text" name="describe" id="describe" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="quantity">Quantidade</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
            </div>


            <div class="form-group">
                <label for="requestDate">Data do Pedido</label>
                <input type="date" name="requestDate" id="requestDate" class="form-control" required>
            </div>


            <button type="submit" class="btn btn-primary">Criar Pedido</button>
        </form>
    </div>
@endsection
