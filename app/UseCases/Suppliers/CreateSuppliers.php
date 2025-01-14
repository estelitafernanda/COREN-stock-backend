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
    public function execute(array $validated): Supplier
    {
        return Supplier::create($validated);
    }
}
