<?php

namespace App\UseCases\Movement;

use App\Models\Movement;
use Illuminate\Validation\ValidationException;

class UpdateMovement
{
    /**
     * Handle the updating of a movement.
     *
     * @param Movement $movement
     * @param array $data
     * @return Movement
     */
    public function execute(Movement $movement, array $data)
    {
        
        $this->validate($data);

        $movement->update($data);

        return $movement;
    }

    /**
     * Validates the movement data.
     *
     * @param array $data
     * @throws ValidationException
     */
    private function validate(array $data)
    {
        $validator = \Validator::make($data, [
            'idProduct' => 'required|integer|exists:products,idProduct',
            'quantity' => 'required|integer|min:1',
            'movementDate' => 'required|date',
            'idUserRequest' => 'required|integer|exists:request,idUser',
            'idUserResponse' => 'required|integer|exists:users, idUser',
            'idOriginSector' => 'nullable|integer|exists:sectors,idSector',
            'idDestinationSector' => 'required|integer|exists:sectors,idSector',
            'movementStatus' => 'required|string|max:255',
            'type' => 'required|string|exists: request, type',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
