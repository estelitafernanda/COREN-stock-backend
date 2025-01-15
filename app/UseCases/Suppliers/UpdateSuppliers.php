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
     * @return bool
     */
    public function execute(Supplier $supplier, array $validated): bool
    {
        return $supplier->update($validated);
    }
}
