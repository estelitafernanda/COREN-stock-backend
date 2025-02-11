<?php

namespace App\UseCases\Suppliers;
use Illuminate\Http\Request; 

use App\Models\Supplier;

class CreateSupplier
{
    /**
     * Handle the creation of a new supplier.
     *
     * @param array $validated
     * @return Supplier
     */
    public function execute(Request $request)
    {
    
        $request->validate([
            'name' => 'required|string|max:255',
            'telephone' => 'required|string',
            'corporateReason' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'cnpj' => 'required|string',
            'responsible' => 'required|string',
            'products' => 'required|array',
            'products.*' => 'exists:products,idProduct',
        ]);

    
        $supplier = Supplier::create([
            'name' => $request->name,
            'cnpj' => $request->cnpj,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'corporateReason' => $request->corporateReason,
            'email' => $request->email,
            'responsible' => $request->responsible,
        ]);

    
        $supplier->products()->attach($request->products);

        
        $supplier = Supplier::with('products')->find($supplier->id);

        return $supplier;
    }
}
