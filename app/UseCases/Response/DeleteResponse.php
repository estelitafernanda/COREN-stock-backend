<?php

namespace App\UseCases\Response;

use App\Models\Response;

class DeleteResponse
{
    /**
     * Handle the deletion of a response.
     *
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        $response = Response::findOrFail($id);
        return $response->delete();
    }
}
