<?php

namespace App\UseCases\Request;

use App\Models\RequestModel;

class UpdateRequest
{
    /**
     * Handle the update of a request.
     *
     * @param RequestModel $requestData
     * @param array $validated
     * @return bool
     */
    public function execute(RequestModel $requestData, array $validated): bool
    {
        return $requestData->update($validated);
    }
}
