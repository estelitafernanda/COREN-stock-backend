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
    public function execute(string $id)
    {
        $request = Movement::find($id);

        if (!$request) {
            throw new ModelNotFoundException("Movimento não encontrado.");
        }

        return $request->delete();
    }
}
