<?php

namespace App\UseCases\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

class UpdateProduct
{
    /**
     *
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function execute(Request $request, string $id): RedirectResponse
    {

        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:products,code,' . $id,
            'nameProduct' => 'required|string|max:255',
            'idDepartment' => 'required|integer|exists:departments,idDepartment',
            'describe' => 'nullable|string|max:500',
            'minQuantity' => 'required|integer|min:0',
            'currentQuantity' => 'required|integer|min:0',
            'location' => 'nullable|string|max:255',
            'validity' => 'nullable|date',
            'unitPrice' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Produto atualizado com sucesso!');
    }
}
