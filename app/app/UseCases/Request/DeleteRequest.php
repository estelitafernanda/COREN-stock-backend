<?php

namespace App\UseCases\Request;

use App\Models\RequestModel;

class DeleteRequest
{
    /**
     * Handle the deletion of a request.
     *
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        $requestData = RequestModel::findOrFail($id);
        return $requestData->delete();
    }
}
