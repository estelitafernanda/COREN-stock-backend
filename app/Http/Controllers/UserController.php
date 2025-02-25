<?php
namespace App\Http\Controllers;

use App\UseCases\User\CreateUser;
use App\UseCases\User\DeleteUser;
use App\UseCases\User\UpdateUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sector;

class UserController extends Controller
{
    protected $createUser;
    protected $deleteUser;
    protected $updateUser;

    public function __construct(CreateUser $createUser, DeleteUser $deleteUser, UpdateUser $updateUser)
    {
        $this->createUser = $createUser;
        $this->deleteUser = $deleteUser;
        $this->updateUser = $updateUser;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = User::with(['sector'])->get();

        $requests = $requests->map(function($request) {
            $request->sector_name = $request->sector ? $request->sector->name : 'Setor não encontrado';
            
            unset($request->idSector);
            unset($request->sector);
    
            return $request;
        });
    
        return response()->json($requests);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $user = User::fetchFromKeycloak();
        $sectors = Sector::all();
        return view('users.create', compact('user', 'sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = $this->createUser->execute($request->all());
            return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar o usuário: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idUser)
    {
        $user = User::findOrFail($idUser);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idUser)
    {
        $user = User::findOrFail($idUser);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idUser)
    {
        try {
            $user = User::findOrFail($idUser);
    
            $this->updateUser->execute($idUser, $request->all());
    
            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar o usuário: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idUser)
    {
        try {
            $this->deleteUser->execute($idUser);
            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir o usuário: ' . $e->getMessage());
        }
    }
}
