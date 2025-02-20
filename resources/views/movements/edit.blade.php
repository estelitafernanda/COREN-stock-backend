@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alterar Status da Movimentação</h1>
    <form action="{{ route('movements.index') }}" method="POST">
        @csrf

        {{-- Pedido () --}}
        <div class="form-group">
            <label for="idMovement">Pedido</label>
            <select id="idMovement" name="idMovement" class="form-control @error('idMovement') is-invalid @enderror" required>
                <option value="">Selecione o pedido</option>
                @foreach($movements as $movement)
                    <option value="{{ $movement->idMovement }}" {{ old('idMovement') == $movement->idMovement ? 'selected' : '' }}>
                        Pedido #{{ $movement->idMovement }} - {{ $movement->description }}
                    </option>
                @endforeach
            </select>
            @error('idMovement')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Status da Movimentação --}}
        <div class="form-group">
            <label for="movementStatus">Status da Movimentação</label>
            <select id="movementStatus" name="movementStatus" class="form-control @error('movementStatus') is-invalid @enderror" required>
                <option value="">Selecione o status</option>
                <option value="aceito" {{ old('movementStatus') == 'aceito' ? 'selected' : '' }}>Aceito</option>
                <option value="negado" {{ old('movementStatus') == 'negado' ? 'selected' : '' }}>Negado</option>
                <option value="pendente" {{ old('movementStatus') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="entregue" {{ old('movementStatus') == 'entregue' ? 'selected' : '' }}>Entregue</option>
            </select>
            @error('movementStatus')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botão de Enviar --}}
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
