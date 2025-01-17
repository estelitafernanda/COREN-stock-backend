<?php

namespace App\UseCases\Response;

use App\Models\Response;

class UpdateResponse
{
    /**
     * Handle the update of a response.
     *
     * @param Response $response
     * @param array $validated
     * @return bool
     */
    public function execute(Response $response, array $validated): bool
    {
        return $response->update($validated);
    }
}
