<?php

namespace App\UseCases\Suppliers;

use App\Models\Supplier;

class UpdateSupplier
{
    /**
     * Handle the update of a supplier.
     *
     * @param Supplier $supplier
     * @param array $validated
     */
    public function execute(string $idSupplier, array $data)
    {
        $supplier = Supplier::findOrFail($idSupplier);

        $validated = validator($data,[
            'corporateReason' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ])->validate();

        $supplier->update([
            'name' => $validated['name'],
            'corporateReason' => $validated['corporateReason'],
            'address' => $validated['address'],
            'contact' => $validated['contact'],
        ]);

        return $supplier;
    }
}
