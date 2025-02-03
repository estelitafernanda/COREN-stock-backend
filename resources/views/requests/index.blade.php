<!-- resources/views/requests/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Filtros de Pedidos</h1>
        <form action="{{ route('requests.index') }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <label for="product_id">Produto</label>
                    <select name="product_id" id="product_id" class="form-control">
                        <option value="">Selecione um produto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->idProduct }}" {{ request('product_id') == $product->idProduct ? 'selected' : '' }}>
                                {{ $product->nameProduct }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Selecione o status</option>
                        <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="aceito" {{ request('status') == 'aceito' ? 'selected' : '' }}>Aceito</option>
                        <option value="rejeitado" {{ request('status') == 'rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="date">Data</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <label for="user_id">Usuário</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">Selecione um usuário</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->idUser }}" {{ request('user_id') == $user->idUser ? 'selected' : '' }}>
                                {{ $user->nameUser }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                    <a href="{{ route('requests.index') }}" class="btn btn-secondary">Limpar Filtros</a>
                </div>
            </div>
        </form>

        <hr>

        <h2>Lista de Pedidos</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Usuário</th>
                    <th>Setor</th>
                    <th>Data do Pedido</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->product_name }}</td>
                        <td>{{ $request->user_name }}</td>
                        <td>{{ $request->sector_name }}</td>
                        <td>{{ $request->requestDate }}</td>
                        <td>{{ $request->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $requests->links() }}
        </div>
    </div>
@endsection