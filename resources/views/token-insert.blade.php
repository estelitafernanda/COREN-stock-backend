<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Token</title>
</head>
<body>
    <h1>Insira o Token JWT</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('token.validate') }}" method="POST">
        @csrf
        <label for="token">Token JWT:</label>
        <input type="text" name="token" id="token" required>
        <button type="submit">Validar Token</button>
    </form>
</body>
</html>
