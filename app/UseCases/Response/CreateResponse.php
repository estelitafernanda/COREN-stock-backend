<?php

namespace App\UseCases\Response;

use App\Models\Response;

class CreateResponse
{
    /**
     * Handle the creation of a new response.
     *
     * @param array $validated
     * @return Response
     */
    public function execute(array $validated): Response
    {
        return Response::create($validated);
    }
}
