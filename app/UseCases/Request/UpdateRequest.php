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
     */
    public function execute(string $id, array $data)
    {
        $request = RequestModel::findOrFail($id);

        $validated = validator($data, [
           'idProduct' => 'required|integer|exists:products,idProduct',
            'idUser' => 'required|integer|exists:users,idUser',
            'describe' => 'required|string|max:255',
            'status' => 'required|string|max:255', 
            'requestDate' => 'required|date',
            'quantity' => 'required|integer|min:1',
        ])->validate();

        $request->update([
            'idProduct' => $validated['idProduct'],
            'idUser' => $validated['idUser'],
            'status' => $validated['status'], 
            'describe' => $validated['describe'],
            'requestDate' => $validated['requestDate'],
            'quantity' => $validated['quantity'],
        ]);

        return $request;
    }
}
