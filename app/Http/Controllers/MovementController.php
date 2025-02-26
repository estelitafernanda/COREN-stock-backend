<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\Product; 
use App\Models\User; 
use App\UseCases\Movement\DeleteMovement;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function filterMovements($query)
{
    $query->when(request('product_name'), function ($q) {
        return $q->whereHas('product', function ($q) {
            $q->where('nameProduct', request('product_name'));
        });
    });
    $query->when(request('type'), function ($q) {
        return $q->where('type', request('type'));
    });
    
    $query->when(request('movementStatus'), function ($q) {
        return $q->where('movementStatus', request('movementStatus'));
    });

    $query->when(request('user_name_request'), function ($q) {
        return $q->whereHas('userRequest', function ($q) {
            $q->where('nameUser', request('user_name_request'));
        });
    });

    $query->when(request('movementDate'), function ($q) {
        return $q->where('movementDate', request('movementDate'));
    });
    
    return $query;
}
    public function index(Request $request)
    {
        $query = Movement::with(['product', 'userRequest.sector', 'request']);
        $query = $this->filterMovements($query);
    
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('type', 'LIKE', "%{$search}%")
                ->orWhereHas('product', function ($q) use ($search) {
                $q->where('nameProduct', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('userRequest', function ($q) use ($search) {
                $q->where('nameUser', 'LIKE', "%{$search}%");
            });
        }
    
        $movements = $query->paginate(3);
        $movements->appends(request()->query());
    
        $movements->getCollection()->transform(function ($movement) {
            return [
                'idMovement' => $movement->idMovement,
                'quantity' => $movement->quantity,
                'movementDate' => $movement->movementDate,
                'movementStatus' => $movement->movementStatus,
                'idUserResponse' => $movement->idUserResponse,
                'idRequest' => $movement->idRequest,
                'type' => $movement->type, 
    
                'product_name' => $movement->product->nameProduct,
                'currentQuantity' => $movement->product->currentQuantity,
    
                'user_name_request' => $movement->userRequest->nameUser,
                'user_sector' => $movement->userRequest->sector->name,

                'request_describe' => $movement->request->describe ,
            ];
        });
    
        $products = Product::all(); 
        $users = User::fetchFromKeycloak();

        return response()->json($movements);
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
            'type' => 'required|string|exists: request, type', 
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

        'product_name' => $movement->product->nameProduct,
        'product_price' =>  $movement->product->unitPrice,
        'currentQuantity' =>  $movement->product->currentQuantity,

        'type' => $movement->type, 
        'user_name_request' =>  $movement->userRequest->nameUser,
        'user_sector' =>  $movement->userRequest->sector->name,

        'request_describe' =>  $movement->request->describe,

        'destination_sector_name' =>  $movement->destinationSector->name,
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
    public function update(Request $request, string $id)
    {
        $movement = Movement::find($id);
        
        if (!$movement) {
            return response()->json(['message' => 'Movimento não encontrado'], 404);
        }

        $produto = $movement->product; 
        
        if ($movement->quantity > $produto->currentQuantity && $movement->type === 'Saida') {
            return response()->json(['message' => 'Quantidade insuficiente no estoque'], 400);
        }

        if ($movement->type === 'Entrada' || $movement->type === 'Saida') {
            $movement->movementStatus = 'entregue';
            $movement->save();
            $movement->atualizarQuantidadeProduto();
        }        

        return response()->json([
            'message' => 'Movimento atualizado com sucesso',
            'movement' => $movement
        ], 200);
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
