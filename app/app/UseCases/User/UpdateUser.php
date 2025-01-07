<?php
namespace App\UseCases\User;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class UpdateUser
{
    /**
     * Executa o caso de uso para atualizar um usuário.
     */
    public function execute(string $userId, array $data)
    {
        // Validar os dados de entrada
        $user = User::findOrFail($userId);

        $validated = validator($data, [
            'nameUser' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed',
        ])->validate();

        // Atualiza os dados do usuário
        $user->update([
            'nameUser' => $validated['nameUser'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);

        return $user;
    }
}
