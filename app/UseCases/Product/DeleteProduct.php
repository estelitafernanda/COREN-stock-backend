<?php
namespace App\UseCases\Product;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteProduct
{
    /**
     * Exclui um produto do banco de dados.
     *
     * @param string $id
     * @return RedirectResponse
     * @throws ModelNotFoundException
     */
    public function execute(string $id): RedirectResponse
    {
        $product = Product::find($id);

        if (!$product) {
            throw new ModelNotFoundException("Produto não encontrado.");
        }

        // Perform the deletion
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');
    }
}
