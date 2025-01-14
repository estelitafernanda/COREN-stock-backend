<?php

namespace App\UseCases\Sector;

use App\Models\Sector;

class CreateSector
{
    /**
     * Handle the creation of a new sector.
     *
     * @param array $validated
     * @return Sector
     */
    public function execute(array $validated): Sector
    {
        return Sector::create($validated);
    }
}
