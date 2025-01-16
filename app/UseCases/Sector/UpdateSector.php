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
     */
    public function execute(string $id, array $data)
    {
        $sector = Sector::findOrFail($id);

        $validated = validator($data, [
            'name' => 'required|string|max:255',
            'headSector' => 'required|string|max:255',
        ])->validate();

        $sector->update([
            'name' => $validated['name'],
            'headSector' => $validated['headSector'],
        ]);

        return $sector;
    }
}
