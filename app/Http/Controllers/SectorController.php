<?php

namespace App\Http\Controllers;

use App\Models\Sector; 
use Illuminate\Http\Request;
use App\UseCases\Sector\CreateSector;
use App\UseCases\Sector\UpdateSector;
use App\UseCases\Sector\DeleteSector;

class SectorController extends Controller
{
    protected $createSector;
    protected $deleteSector;
    protected $updateSector;

    public function __construct(CreateSector $createSector, DeleteSector $deleteSector, UpdateSector $updateSector)
    {
        $this->createSector = $createSector;
        $this->deleteSector = $deleteSector;
        $this->updateSector = $updateSector;
    }

    public function index()
    {
        $sectors = Sector::withCount('users')->paginate(4);
        // return view('sectors.index', compact('sectors'));
        return response()->json($sectors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sector = Sector::all();
        return view('sectors.create', compact('sector'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateSector $createSector)
    {
        try {
            $sector = $this->createSector->execute($request->all());
            return redirect()->route('sectors.index')->with('success', 'Setor criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar o usuário: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idSector)
    {
        try {
            $sector = Sector::with(['users:idUser,idSector,nameUser,role'])->findOrFail($idSector);

            $formattedUsers = $sector->users->map(function ($user) {
                return [
                    'nameUser' => $user->nameUser,
                    'role' => $user->role
                ];
            });

            return response()->json([
                'idSector' => $sector->idSector,
                'name' => $sector->name,
                'headSector' => $sector->headSector,
                'unity' => $sector->unity,
                'users' => $formattedUsers
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Setor não encontrado: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idSector)
    {
        $sector = Sector::findOrFail($idSector);
        return view('sectors.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, UpdateSector $updateSector)
    {
        try {
            $sector = Sector::findOrFail($id);
    
            $this->updateSector->execute($id, $request->all());
    
            return redirect()->route('sectors.index')->with('success', 'setor atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar o setor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteSector $deleteSector)
    {
        try {
            $this->deleteSector->execute($id);
            return redirect()->route('sectors.index')->with('success', 'Setor excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir o setor: ' . $e->getMessage());
        }
    }
    public function listProducts($idSector){
        $sector = Sector::findOrFail($idSector);
        $products = $sector->listProducts();

        return view('sectors.products', compact('sector', 'products'));
    }
    public function targetProducts($id){
        $sector = Sector::findOrFail($id);
        $products = $sector->targetProducts();

        return view('sectors.target-products', compact('sector', 'products'));
    }
}
