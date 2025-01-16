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
     */
    public function execute(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new ModelNotFoundException("Usuário não encontrado.");
        }

        return $product->delete();
    }
}
