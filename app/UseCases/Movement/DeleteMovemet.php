<?php

namespace App\UseCases\Movement;

use App\Models\Movement;

class DeleteMovement
{
    /**
     * Handle the deletion of a movement.
     *
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        $movement = Movement::findOrFail($id);

        return $movement->delete();
    }
}
