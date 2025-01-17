<?php

namespace App\UseCases\Suppliers;

use App\Models\Supplier;

class CreateSupplier
{
    /**
     * Handle the creation of a new supplier.
     *
     * @param array $validated
     * @return Supplier
     */
    public function execute(array $data)
    {
        $validated = validator($data, [
            'corporateReason' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            
        ])->validate();

        return Supplier::create([
            'corporateReason' => $validated['corporateReason'],
            'name' => $validated['name'],
            'address' => $validated['address'],
            'contact' => $validated['contact'],
        ]);
    }
}
