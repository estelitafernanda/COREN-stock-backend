<?php

namespace App\UseCases\Product;

use App\Models\Product;
use Illuminate\Http\Request;

class CreateProduct
{
    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function execute(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:products,code',
            'nameProduct' => 'required|string|max:255',
            'idDepartment' => 'required|integer|exists:departments,idDepartment',
            'describe' => 'nullable|string|max:500',
            'minQuantity' => 'required|integer|min:0',
            'currentQuantity' => 'required|integer|min:0',
            'location' => 'nullable|string|max:255',
            'validity' => 'nullable|date',
            'unitPrice' => 'required|numeric|min:0',
        ]);

        Product::create([
            'code' => $validated['code'],
            'nameProduct' => $validated['nameProduct'],
            'idDepartment' => $validated['idDepartment'],
            'describe' => $validated['describe'] ?? null,
            'minQuantity' => $validated['minQuantity'],
            'currentQuantity' => $validated['currentQuantity'],
            'location' => $validated['location'] ?? null,
            'validity' => $validated['validity'] ?? null,
            'unitPrice' => $validated['unitPrice'],
        ]);

        return redirect()->route('product.index')->with('success', 'Produto criado com sucesso!');
    }
}
