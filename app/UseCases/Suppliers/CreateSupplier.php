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
            'idSupplier' => 'required|integer|unique:suppliers,idSupplier',
            'corporateReason' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            
        ])->validate();

        return Supplier::create([
            'id' => $validated['idSupplier'],
            'corporateReason' => $validated['corporateReason'],
            'name' => $validated['name'],
            'address' => $validated['address'],
            'contact' => $validated['contact'],
        ]);
    }
}
