<?php

namespace App\UseCases\Product;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class DeleteProduct
{
    /**
     * Exclui um produto do banco de dados.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function execute(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $product->delete();
        
        return redirect()->route('product.index')->with('success', 'Produto excluído com sucesso!');
    }
}
