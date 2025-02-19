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

        <form action="{{ route('requests.update', $request->idRequest) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="idProduct">Produto</label>
                <select name="idProduct" id="idProduct" class="form-control" required>
                    <option value="">Selecione o produto</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->idProduct }}" 
                            @if ($product->idProduct == $request->idProduct) selected @endif>
                            {{ $product->nameProduct }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idUser">Usuário</label>
                <select name="idUser" id="idUser" class="form-control" required>
                    <option value="">Selecione o usuário</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->idUser }}" 
                            @if ($user->idUser == $request->idUser) selected @endif>
                            {{ $user->nameUser }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="describe">Descrição</label>
                <input type="text" name="describe" id="describe" class="form-control" 
                    value="{{ old('describe', $request->describe) }}" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantidade</label>
                <input type="number" name="quantity" id="quantity" class="form-control" 
                    value="{{ old('quantity', $request->quantity) }}" required min="1">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" id="status" class="form-control" 
                    value="{{ old('status', $request->status) }}" required>
            </div>

            <div class="form-group">
                <label for="requestDate">Data do Pedido</label>
                <input type="date" name="requestDate" id="requestDate" class="form-control" 
                    value="{{ old('requestDate', \Carbon\Carbon::parse($request->requestDate)->format('Y-m-d')) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('sectors.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
