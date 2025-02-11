<?php

namespace App\UseCases\Request;

use App\Models\RequestModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class CreateRequest
{

    public function execute(array $data)
    {
        $validated = validator($data, [
            'idProduct' => 'required|integer|exists:products,idProduct',
            'idUser' => 'required|integer|exists:users,idUser',
            'describe' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ])->validate();

        return RequestModel::create([
            'idProduct' => $validated['idProduct'],
            'idUser' => $validated['idUser'],
            'describe' => $validated['describe'],
            'quantity' => $validated['quantity'],
        ]);
    }
}
