<?php

namespace App\UseCases\Sector;

use App\Models\Sector;

class UpdateSector
{
    /**
     * Handle the update of a sector.
     *
     * @param Sector $sector
     * @param array $validated
     * @return bool
     */
    public function execute(Sector $sector, array $validated): bool
    {
        return $sector->update($validated);
    }
}
