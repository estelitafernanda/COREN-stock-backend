@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Movimentos</h1>

        <!-- Filtros -->
        <form method="GET" action="{{ route('movements.index') }}">
            <div class="row mb-3">
                <!-- Select para Produto -->
                <div class="col">
                    <label for="product_name">Nome do Produto</label>
                    <select id="product_name" name="product_name" class="form-control">
                        <option value="">Selecione um Produto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->nameProduct }}" 
                                    {{ request('product_name') == $product->nameProduct ? 'selected' : '' }}>
                                {{ $product->nameProduct }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Select para Status do Movimento -->
                <div class="col">
                    <label for="movementStatus">Status do Movimento</label>
                    <select id="movementStatus" name="movementStatus" class="form-control">
                        <option value="">Selecione um Status</option>
                        <option value="pendente" {{ request('movementStatus') == 'entregue' ? 'selected' : '' }}>entregue</option>
                        <option value="concluido" {{ request('movementStatus') == 'Em_Espera' ? 'selected' : '' }}>Em Espera</option>
                    </select>
                </div>

                <!-- Select para Solicitante -->
                <div class="col">
                    <label for="user_name_request">Solicitante</label>
                    <select id="user_name_request" name="user_name_request" class="form-control">
                        <option value="">Selecione um Solicitante</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->nameUser }}" 
                                    {{ request('user_name_request') == $user->nameUser ? 'selected' : '' }}>
                                {{ $user->nameUser }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Select para Data do Movimento -->
                <div class="col">
                    <label for="movementDate">Data do Movimento</label>
                    <input type="date" id="movementDate" name="movementDate" value="{{ request('movementDate') }}" class="form-control">
                </div>

                <div class="col align-self-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Tabela de Movimentos -->
        @if($movements->isEmpty())
            <p>Nenhum movimento encontrado para os filtros selecionados.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Movimento</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Data do Movimento</th>
                        <th>Status</th>
                        <th>Solicitante</th>
                        <th>Setor</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movements as $movement)
                        <tr>
                            <td>{{ $movement['idMovement'] }}</td>
                            <td>{{ $movement['product_name'] }}</td>
                            <td>{{ $movement['quantity'] }}</td>
                            <td>{{ $movement['movementDate'] }}</td>
                            <td>{{ $movement['movementStatus'] }}</td>
                            <td>{{ $movement['user_name_request'] }}</td>
                            <td>{{ $movement['user_sector'] }}</td>
                            <td>{{ $movement['request_describe'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Paginação -->
        <div class="d-flex justify-content-between">
            <div>
                Exibindo {{ $movements->firstItem() }} até {{ $movements->lastItem() }} de {{ $movements->total() }} movimentos.
            </div>
            <div>
                @if ($movements->currentPage() > 1)
                    <a href="{{ $movements->previousPageUrl() }}" class="btn btn-secondary">Anterior</a>
                @endif
                @if ($movements->hasMorePages())
                    <a href="{{ $movements->nextPageUrl() }}" class="btn btn-secondary">Próximo</a>
                @endif
            </div>
        </div>
    </div>
@endsection
