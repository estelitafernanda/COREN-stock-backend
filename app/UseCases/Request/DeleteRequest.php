<?php

namespace App\UseCases\Request;

use App\Models\RequestModel;
class DeleteRequest
{
    /**
     * Handle the deletion of a request.
     *
     * @param string $id
     */
    public function execute(string $id)
    {
        $request = RequestModel::find($id);

        if (!$request) {
            throw new ModelNotFoundException("Pedido não encontrado.");
        }

        return $request->delete();
    }
}
