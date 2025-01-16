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
    public function execute(string $id)
    {

        $supplier = Supplier::find($id);

        if (!$supplier) {
            throw new ModelNotFoundException("Fornecedor não encontrado.");
        }

        return $supplier->delete();
    }
}
