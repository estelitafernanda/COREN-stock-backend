<?php

namespace App\UseCases\Product;

use App\Models\Product;
use Illuminate\Validation\ValidationException;

class UpdateProduct
{
    /**
     *
     * @param string $id
     * @throws ValidationException
     */
    public function execute( string $id, array $data,)
    {
        $product = Product::findOrFail($id);
        
        $validated = validator($data, [
            'nameProduct' => 'required|string|max:255',
            'image' => 'nullable|string',
            'code' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'idDepartment' => 'required|integer|exists:sectors,id',
            'describe' => 'nullable|string|max:500',
            'minQuantity' => 'required|integer|min:0',
            'currentQuantity' => 'required|integer|min:0',
            'location' => 'nullable|string|max:255',
            'validity' => 'nullable|date',
            'unitPrice' => 'required|numeric|min:0',
        ])->validate();
        
        $product->update([
            'nameProduct' => $validated['nameProduct'],
            'image' => $validated['image'],
            'code' => $validated['code'],
            'category' => $validated['category'],
            'idDepartment' => $validated['idDepartment'],
            'describe' => $validated['describe'],
            'minQuantity' => $validated['minQuantity'],
            'currentQuantity' => $validated['currentQuantity'],
            'location' => $validated['location'],
            'validity' => $validated['validity'],
            'unitPrice' => $validated['unitPrice'],            
        ]);

        return $product;
    }
}
