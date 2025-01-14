<?php
namespace App\UseCases\User;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class UpdateUser
{
    /**
     * Executa o caso de uso para atualizar um usuário.
     */
    public function execute(string $idUser, array $data)
{
        $user = User::findOrFail($idUser);

        $emailRule = 'required|email|unique:users,email,' . $user->idUser . ',idUser';

        $validated = validator($data, [
            'nameUser' => 'required|string|max:255',
            'email' => $emailRule, 
            'role' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed',
        ])->validate();
        
        $password = $validated['password'] ? bcrypt($validated['password']) : $user->password;

        $user->update([
            'nameUser' => $validated['nameUser'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => $password,
        ]);

        return $user;
    }
}
