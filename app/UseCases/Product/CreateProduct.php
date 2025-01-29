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
    public function execute(array $data)
    {   

        if (isset($data['image']) && $data['image'] !== null) {
            $requestImage = $data['image'];
            $extension = $requestImage->getClientOriginalExtension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $data['image'] = strval($imageName);
        }

        if ($data['validity'] === null) {
            $data['validity'] = 'Não Perecivel';
        }
        
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

        return Product::create([
            'nameProduct' => $validated['nameProduct'],
            'code' => $validated['code'],
            'image' => $validated['image'] ?? null,
            'category' => $validated['category'],
            'idDepartment' => $validated['idDepartment'],
            'describe' => $validated['describe'] ?? null,
            'minQuantity' => $validated['minQuantity'],
            'currentQuantity' => $validated['currentQuantity'],
            'location' => $validated['location'] ?? null,
            'validity' => $validated['validity'] ?? null,
            'unitPrice' => $validated['unitPrice'],
        ]);
    }
}