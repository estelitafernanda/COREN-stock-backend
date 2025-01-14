<?php

namespace App\Http\Controllers;

use App\Models\Supplier; 
use Illuminate\Http\Request;
use App\UseCases\Suppliers\CreateSupplier;
use App\UseCases\Suppliers\UpdateSupplier;
use App\UseCases\Suppliers\DeleteSupplier;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados = Supplier::all();
        return view('supplier.index', compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateSupplier $createSupplier)
    {
        $validated = $request->validate([
            'corporateReason' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ]);

        $createSupplier->execute($validated);

        return redirect()->route('supplier.index')->with('success', 'Fornecedor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, UpdateSupplier $updateSupplier)
    {
        $validated = $request->validate([
            'corporateReason' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);

        $updateSupplier->execute($supplier, $validated);

        return redirect()->route('supplier.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteSupplier $deleteSupplier)
    {
        $deleteSupplier->execute($id);

        return redirect()->route('supplier.index')->with('success', 'Fornecedor excluído com sucesso!');
    }
}
