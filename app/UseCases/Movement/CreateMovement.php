<?php

namespace App\UseCases\Movement;

use App\Models\Movement;
use Illuminate\Validation\ValidationException;

class CreateMovement
{
    /**
     * Handle the creation of a new movement.
     *
     * @param array $data
     * @return Movement
     */
    public function execute(array $data)
    {
        
        $this->validate($data);

        return Movement::create($data);
    }

    /**
     * Validates the movement data.
     *
     * @param array $data
     * @throws ValidationException
     */
    private function validate(array $data)
    {
        $validator = Validator::make($data, [
            'idProduct' => 'required|integer|exists:products,idProduct',
            'quantity' => 'required|integer|min:1',
            'movementDate' => 'required|date',
            'idRequest' => 'required|integer|exists:request, idRequest',
            'idUserRequest' => 'required|integer|exists:request,idUser',
            'idUserResponse' => 'required|integer|exists:users, idUser',
            'type' => 'required|string|exists: request, type', 
            'idOriginSector' => 'nullable|integer|exists:sectors,idSector',
            'idDestinationSector' => 'required|integer|exists:sectors,idSector',
            'movementStatus' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
