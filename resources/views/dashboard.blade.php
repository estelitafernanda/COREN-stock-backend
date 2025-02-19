@extends('layouts.app')

@section('content')
    <h1>Bem-vindo, {{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <p>Token JWT: {{ $user->token }}</p>
    <a href="{{ route('logout') }}">Sair</a>
@endsection
