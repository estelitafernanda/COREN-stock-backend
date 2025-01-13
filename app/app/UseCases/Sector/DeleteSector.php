<?php

namespace App\UseCases\Sector;

use App\Models\Sector;

class DeleteSector
{
    /**
     * Handle the deletion of a sector.
     *
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        $sector = Sector::findOrFail($id);
        return $sector->delete();
    }
}
