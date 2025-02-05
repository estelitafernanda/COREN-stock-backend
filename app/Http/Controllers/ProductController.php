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


    public function filterByCategory($category)
    {
        return Product::where('category', $category)->paginate(7);
    }
    
    public function index(Request $request)
    {
        try {
            $category = $request->input('category');
            $search = $request->input('search');
    
            if ($category) {
                $products = $this->filterByCategory($category);
            }else {
                if (!empty($search)) {
                    $query = Product::where('nameProduct', 'LIKE', "%{$search}%")
                                    ->orWhere('describe', 'LIKE', "%{$search}%");
    
                    $products = $query->paginate(7);
                } else {
                    $products = Product::paginate(7);
                }
            }

            // return view('product.index', compact('products'));
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao listar os produtos: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
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
        return $product;
        // return view('product.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idProduct)
    {
        $product = Product::findOrFail($idProduct);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idProduct)
    {
        try {
            $product = Product::findOrFail($idProduct);
    
            $this->updateProduct->execute($idProduct, $request->all());
    
            return response()->json(['message' => 'Produto atualizado com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o produto: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->deleteProduct->execute($id);
            return response()->json(['message' => 'Produto excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return back()->json(['error' => 'Erro ao excluir o produto: ' . $e->getMessage()], 500);
        }
    }

    public function showFiltered(){
        $results = Product::all();
        return $results;
    }
}