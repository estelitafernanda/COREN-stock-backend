<?php

namespace App\Http\Controllers;

use App\Models\Supplier; 
use App\Models\Product;
use Illuminate\Http\Request;
use App\UseCases\Suppliers\CreateSupplier;
use App\UseCases\Suppliers\UpdateSupplier;
use App\UseCases\Suppliers\DeleteSupplier;

class SuppliersController extends Controller
{
    protected $createSupplier;
    protected $deleteSupplier;
    protected $updateSupplier;

    public function __construct(CreateSupplier $createSupplier, DeleteSupplier $deleteSupplier, UpdateSupplier $updateSupplier)
    {
        $this->createSupplier = $createSupplier;
        $this->deleteSupplier = $deleteSupplier;
        $this->updateSupplier = $updateSupplier;
    }


    public function filterSuppliers($query)
    {
        $query->when(request('name'), function ($q) {
            return $q->where('name', 'like', '%' . request('name') . '%');
        });
        $query->when(request('address'), function ($q) {
            return $q->where('address', request('address'));
        });
        
        $query->when(request('telephone'), function ($q) {
            return $q->where('telephone', request('telephone'));
        });

        $query->when(request('responsible'), function ($q) {
            return $q->where('responsible', request('responsible'));
        });

        $query->when(request('cnpj'), function ($q) {
            return $q->where('cnpj', request('cnpj'));
        });
        $query->when(request('email'), function ($q){
            return $q->where('email', request('email'));
        });

        return $query;
    }
    public function search(){
        
    }
    public function index()
    {
        $query = Supplier::with('products');
        $query = $this->filterSuppliers($query);
    
        $suppliers = $query->paginate(4);
        $suppliers->appends(request()->query());

        return response()->json($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('suppliers.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateSupplier $createSupplier)
    {
        $supplier = $this->createSupplier->execute($request);

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::with('products')->findOrFail($id);

        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idSupplier, UpdateSupplier $updateSupplier)
    {
        try {
            $supplier = Supplier::findOrFail($idSupplier);
    
            $this->updateSupplier->execute($idSupplier, $request->all());
    
            return response()->json([
                'message' => 'Fornecedor atualizado com sucesso', 
            ], 200);

        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar o Fornecedor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteSupplier $deleteSupplier)
    {
        try {
            $this->deleteSupplier->execute($id);
            return response()->json(['message' => 'Fornecedor excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o Fornecedor: ' . $e->getMessage()], 500);
        }
    }
}
