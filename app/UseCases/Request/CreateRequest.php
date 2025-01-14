<?php

namespace App\UseCases\Request;

use App\Models\RequestModel;

class CreateRequest
{
    /**
     * Handle the creation of a new request.
     *
     * @param array $validated
     * @return RequestModel
     */
    public function execute(array $validated): RequestModel
    {
        return RequestModel::create($validated);
    }
}
