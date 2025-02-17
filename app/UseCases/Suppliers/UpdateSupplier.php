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
            'telephone' => 'required|string|',
            'responsible' => 'required|string',
            'cnpj' => 'required|string',
            'email' => 'required|email',

        ])->validate();

        $supplier->update([
            'name' => $validated['name'],
            'corporateReason' => $validated['corporateReason'],
            'address' => $validated['address'],
            'telephone' => $validated['telephone'],
            'responsible' => $validated['responsible'],
            'cnpj' => $validated['cnpj'],
            'email' => $validated['email'],
        ]);

        return $supplier;
    }
}
