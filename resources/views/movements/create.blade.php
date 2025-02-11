@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alterar Status da Movimentação</h1>
    <form action="{{ route('movements.store') }}" method="POST">
        @csrf

        {{-- Pedido (idUserRequest) --}}
        <div class="form-group">
            <label for="idUserRequest">Pedido</label>
            <select id="idUserRequest" name="idUserRequest" class="form-control @error('idUserRequest') is-invalid @enderror" required>
                <option value="">Selecione o pedido</option>
                @foreach($requests as $request)
                    <option value="{{ $request->idUser }}" {{ old('idUserRequest') == $request->idUser ? 'selected' : '' }}>
                        Pedido #{{ $request->idUser }} - {{ $request->description }}
                    </option>
                @endforeach
            </select>
            @error('idUserRequest')
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
