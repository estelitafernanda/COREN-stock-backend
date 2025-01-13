<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\UseCases\Product\CreateProduct;
use App\UseCases\Product\UpdateProduct;
use App\UseCases\Product\DeleteProduct;

class ProductController extends Controller
{

    protected $createProduct;
    protected $deleteProduct;
    protected $updateProduct;

    public function __construct(CreateProduct $createProduct, DeleteProduct $deleteProduct, UpdateProduct $updateProduct)
    {
        $this->createProduct = $createProduct;
        $this->deleteProduct = $deleteProduct;
        $this->updateProduct = $updateProduct;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            if($request->hasFile('image') && $request->file('image')->isValid()){
                
                $requestImage = $request->file('image'); 

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('images/products'), $imageName);  

                $request->merge(['image' => $imageName]);
            };
            
            $product = $this->createProduct->execute($request->all());

            return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar o Produto: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Atualiza o produto utilizando o caso de uso UpdateProduct
        $useCase = new UpdateProduct();
        return $useCase->execute($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $useCase = new DeleteProduct();
        return $useCase->execute($id);
    }
}
