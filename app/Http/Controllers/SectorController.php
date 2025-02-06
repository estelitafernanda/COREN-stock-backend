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
    public function filterSectors($query)
    {

        $query->when(request('unity'), function ($q) {
            return $q->where('unity', request('unity'));
        });
        
        $query->when(request('name'), function ($q) {
            return $q->where('name', request('name'));
        });

        $query->when(request('headSector'), function ($q) {
            return $q->where('headSector', request('headSector'));
        });
        
        return $query;
    }

    public function index(Request $request)
    {
        $query = Sector::withCount('users');
        $query = $this->filterSectors($query);

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('unity', 'LIKE', "%{$search}%")
            ->orWhere('headSector', 'LIKE', "%{$search}%"); 
        }

        $sectors = $query->paginate(4);
        $sectors->appends(request()->query());

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
            $sector = Sector::findOrFail($idSector);
    
            $this->updateSector->execute($idSector, $request->all());
    
            return redirect()->route('sectors.index')->with('success', 'setor atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar o setor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idSector, DeleteSector $deleteSector)
    {
        try {
            $this->deleteSector->execute($idSector);
            return response()->json(['message' => 'Setor excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o setor: ' . $e->getMessage()], 500);
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
