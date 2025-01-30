<?php
namespace App\UseCases\User;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    /**
     * Executa o caso de uso para criar um novo usuário.
     */
    public function execute(array $data)
    {
        // Validação dos dados
        $validated = validator($data, [
            'nameUser' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|string|max:255',
            'idSector' => 'required|exists:sectors,idSector',
        ])->validate();

        // Criação do usuário
        return User::create([
            'nameUser' => $validated['nameUser'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'idSector' => $validated['idSector'], 
        ]);
    }
}
