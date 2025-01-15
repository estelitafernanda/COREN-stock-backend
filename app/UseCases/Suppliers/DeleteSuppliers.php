<?php

namespace App\UseCases\Suppliers;

use App\Models\Supplier;

class DeleteSupplier
{
    /**
     * Handle the deletion of a supplier.
     *
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        $supplier = Supplier::findOrFail($id);
        return $supplier->delete();
    }
}
