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
    public function execute(array $data)
    {
        $validated = validator($data, [
            'name' => 'required|string|max:255',
            'headSector' => 'required|string|max:255', 
        ])->validate();

        return Sector::create([
            'name' => $validated['name'],
            'headSector' => $validated['headSector'],
        ]);
    }
}
