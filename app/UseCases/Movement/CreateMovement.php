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
        $validator = \Validator::make($data, [
            'idProduct' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'movementDate' => 'required|date',
            'idResponsible' => 'required|integer|exists:users,id',
            'idOriginSector' => 'nullable|integer|exists:sectors,id',
            'idDestinationSector' => 'required|integer|exists:sectors,id',
            'movementStatus' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
