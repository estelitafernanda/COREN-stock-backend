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
    public function execute(string $id, array $data)
    {
        $product = Product::findOrFail($id);
        

        $validated = validator($data, [
            'nameProduct' => 'required|string|max:255',
            'image' => 'nullable|string',
            'code' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'idDepartment' => 'required|integer|exists:sectors,idSector',
            'describe' => 'nullable|string|max:500',
            'minQuantity' => 'required|integer|min:0',
            'currentQuantity' => 'required|integer|min:0',
            'location' => 'nullable|string|max:255',
            'validity' => 'nullable|date',
            'unitPrice' => 'required|numeric|min:0',
        ])->validate();
        
        if (isset($data['image']) && $data['image'] !== null) {

            $imageData = $data['image']; 
        

            $imageName = md5($imageData . strtotime("now")) . '.jpg'; 
            
            // Se você for armazenar a imagem fisicamente, faça o upload aqui
            // Por exemplo, para salvar o arquivo em uma pasta pública
            $imagePath = 'images/products/' . $imageName;
            file_put_contents(public_path($imagePath), base64_decode($imageData));  // Aqui você pode salvar a imagem no servidor
            
            // Atribuindo o nome da imagem à variável de dados
            $data['image'] = $imageName;  // A string será o nome da imagem
        }
    
        // Atualizando o produto
        $product->update([
            'nameProduct' => $validated['nameProduct'],
            'image' => $data['image'],  // Agora o campo 'image' armazena o nome da imagem
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
