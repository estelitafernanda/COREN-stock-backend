<?php

namespace App\UseCases\Sector;

use App\Models\Sector;

class DeleteSector
{
    /**
     * Handle the deletion of a sector.
     *
     * @param string $id
     */
    public function execute(string $id)
    {
        // Encontrar o usuário ou lançar exceção caso não exista
        $sector = Sector::find($id);

        if (!$sector) {
            throw new ModelNotFoundException("Setor não encontrado.");
        }

        // Exclui o usuário
        return $sector->delete();
    }
}
