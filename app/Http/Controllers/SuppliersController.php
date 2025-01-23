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

    public function index()
    {
        $suppliers = Supplier::with('products')->paginate(4);
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
    
            return redirect()->route('suppliers.index')->with('success', 'Fornecedor atualizado com sucesso!');
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
            return redirect()->route('suppliers.index')->with('success', 'Fornecedor excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir o Fornecedor: ' . $e->getMessage());
        }
    }
}
