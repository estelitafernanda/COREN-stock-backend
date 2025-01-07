<?php
namespace App\UseCases\User;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteUser
{
    /**
     * Executa o caso de uso para excluir um usuário.
     */
    public function execute(string $userId)
    {
        // Encontrar o usuário ou lançar exceção caso não exista
        $user = User::find($userId);

        if (!$user) {
            throw new ModelNotFoundException("Usuário não encontrado.");
        }

        // Exclui o usuário
        return $user->delete();
    }
}
