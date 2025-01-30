<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use App\UseCases\Movement\DeleteMovement;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = Movement::with(['product', 'userRequest.sector', 'request'])->paginate(3);
    
        $requests->getCollection()->transform(function ($request) {
            return [
                'idMovement' => $request->idMovement,
                'quantity' => $request->quantity,
                'movementDate' => $request->movementDate,
                'movementStatus' => $request->movementStatus,
                'idUserResponse' => $request->idUserResponse,
                'idRequest' => $request->idRequest,
                
                'product_name' => $request->product ? $request->product->nameProduct : 'Produto não encontrado',
                'currentQuantity' => $request->product ? $request->product->currentQuantity : 'Quantidade não encontrada',
        
                'user_name_request' => $request->userRequest ? $request->userRequest->nameUser : 'Usuário não encontrado',
                'user_sector' => $request->userRequest && $request->userRequest->sector ? $request->userRequest->sector->nameSector : 'Setor não encontrado',
        
                'request_describe' => $request->request ? $request->request->describe : 'Descrição não encontrada',
            ];
        });
    
        return response()->json([
            'data' => $requests->items(), 
            'current_page' => $requests->currentPage(),
            'last_page' => $requests->lastPage(),
            'per_page' => $requests->perPage(),
            'total' => $requests->total(),
        ]);

        // return view('movements.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('movements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateMovement $createMovement)
    {
        $validated = $request->validate([
            'idProduct' => 'required|integer|exists:products,idProduct',
            'quantity' => 'required|integer|min:1',
            'movementDate' => 'required|date',
            'idRequest' => 'required|integer|exists:request, idRequest',
            'idUserRequest' => 'required|integer|exists:request,idUser',
            'idUserResponse' => 'required|integer|exists:users, idUser',
            'idOriginSector' => 'nullable|integer|exists:sectors,idSector',
            'idDestinationSector' => 'required|integer|exists:sectors,idSector',
            'movementStatus' => 'required|string|max:255',
        ]);

        $createMovement->execute($validated);

        return redirect()->route('movements.index')->with('success', 'Movimentação criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    $movement = Movement::with(['product', 'userRequest.sector', 'request', 'originSector', 'destinationSector'])
                        ->findOrFail($id);

    return response()->json([
        'idMovement' => $movement->idMovement,
        'quantity' => $movement->quantity,
        'movementDate' => $movement->movementDate,
        'movementStatus' => $movement->movementStatus,
        'idUserResponse' => $movement->idUserResponse,
        'idRequest' => $movement->idRequest,

        'product_name' => $movement->product ? $movement->product->nameProduct : 'Produto não encontrado',
        'product_price' => $movement->product ? $movement->product->unitPrice : 'Preço não encontrado',
        'currentQuantity' => $movement->product ? $movement->product->currentQuantity : 'Quantidade não encontrada',

        'user_name_request' => $movement->userRequest ? $movement->userRequest->nameUser : 'Usuário não encontrado',
        'user_sector' => $movement->userRequest && $movement->userRequest->sector ? $movement->userRequest->sector->name : 'Setor não encontrado',

        'request_describe' => $movement->request ? $movement->request->describe : 'Descrição não encontrada',

        'destination_sector_name' => $movement->destinationSector ? $movement->destinationSector->name : 'Setor de destino não encontrado',
    ]);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movement = Movement::findOrFail($id);
        return view('movements.edit', compact('movement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, UpdateMovement $updateMovement)
    {
        $movement = Movement::findOrFail($id);

        $validated = $request->validate([
            'idProduct' => 'required|integer|exists:products,idProduct',
            'quantity' => 'required|integer|min:1',
            'idRequest' => 'required|integer|exists:request, idRequest',
            'movementDate' => 'required|date',
            'idUserRequest' => 'required|integer|exists:request,idUser',
            'idUserResponse' => 'required|integer|exists:users, idUser',
            'idOriginSector' => 'nullable|integer|exists:sectors,idSector',
            'idDestinationSector' => 'required|integer|exists:sectors,idSector',
            'movementStatus' => 'required|string|max:255',
        ]);

        $updateMovement->execute($movement, $validated);

        return redirect()->route('movements.index')->with('success', 'Movimentação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteMovement $deleteMovement)
    {
        try {
            $this->deleteMovement->execute($id);
            return response()->json(['message' => 'Movimento excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return back()->json(['error' => 'Erro ao excluir o movimento: ' . $e->getMessage()], 500);
        }
    }
}
