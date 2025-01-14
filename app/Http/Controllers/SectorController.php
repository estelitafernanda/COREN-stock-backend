<?php

namespace App\Http\Controllers;

use App\Models\Sector; // Certifique-se de que o modelo Sector existe.
use Illuminate\Http\Request;
use App\UseCases\Sector\CreateSector;
use App\UseCases\Sector\UpdateSector;
use App\UseCases\Sector\DeleteSector;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados = Sector::all();
        return view('sector.index', compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sector.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateSector $createSector)
    {
        $validated = $request->validate([
            'idSector' => 'required|integer',
            'name' => 'required|string|max:255',
            'headSector' => 'required|string|max:255',
        ]);

        $createSector->execute($validated);

        return redirect()->route('sectors.index')->with('success', 'Setor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sector = Sector::findOrFail($id);
        return view('sector.show', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sector = Sector::findOrFail($id);
        return view('sector.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, UpdateSector $updateSector)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'headSector' => 'required|string|max:255',
        ]);

        $sector = Sector::findOrFail($id);

        $updateSector->execute($sector, $validated);

        return redirect()->route('sectors.index')->with('success', 'Setor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteSector $deleteSector)
    {
        $deleteSector->execute($id);

        return redirect()->route('sectors.index')->with('success', 'Setor excluído com sucesso!');
    }
}
