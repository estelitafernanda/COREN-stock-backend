<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestModel;
use App\UseCases\Request\CreateRequest;
use App\UseCases\Request\UpdateRequest;
use App\UseCases\Request\DeleteRequest;
use App\Models\Product;
use App\Models\User;

class RequestController extends Controller
{

    
    private $createRequest;
    private $updateRequest;
    private $deleteRequest;

     
    public function __construct(CreateRequest $createRequest, UpdateRequest $updateRequest, DeleteRequest $deleteRequest)
    {
        $this->updateRequest = $updateRequest;
        $this->deleteRequest = $deleteRequest;
        $this->createRequest = $createRequest;
    }
 
    public function filterRequests($query)
    {

        $query->when(request('product_id'), function ($q) {
            return $q->where('idProduct', request('product_id'));
        });
        
        $query->when(request('status'), function ($q) {
            return $q->where('status', request('status'));
        });

        $query->when(request('date'), function ($q) {
            return $q->whereDate('requestDate', request('date'));
        });

        $query->when(request('user_id'), function ($q) {
            return $q->where('idUser', request('user_id'));
        });
        
        return $query;
    }
    
    public function index()
    {

        $query = RequestModel::with(['product', 'user']);
        $query = $this->filterRequests($query);

        $requests = $query->paginate(4);
        
        $requests->appends(request()->query());
    

        $products = Product::all();
        $users = User::all();
    

        $requests->getCollection()->transform(function($request) {
            $request->product_name = $request->product->nameProduct;
            $request->user_name = $request->user->nameUser;
            $request->sector_name = $request->user->sector->name;
            
            unset($request->idProduct);
            unset($request->idUser);
            unset($request->product);
            unset($request->user);
            
            return $request;
        });

        // return view('requests.index', compact('requests', 'products', 'users'));

        return response()->json($requests);
    }
     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('requests.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $resquestion = $this->createRequest->execute($request->all());
            return redirect()->route('requests.index')->with('success', 'Pedido criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar o pedido: ' . $e->getMessage());
        }

        $validatedData = $request->validate([
            'describe' => 'required|string',
            'idUser' => 'required|exists:users,idUser',
            'idProduct' => 'required|exists:products,idProduct',
            'requestDate' => 'required|date',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $newRequest = RequestModel::create($validatedData);
        $newRequest->criarMovimento();
    
        return response()->json([
            'message' => 'Pedido criado com sucesso e movimentação registrada.',
            'request' => $newRequest,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = RequestModel::with(['product', 'user'])->findOrFail($id);


        $request->product_name = $request->product ? $request->product->nameProduct : 'Produto não encontrado';
        $request->user_name = $request->user ? $request->user->nameUser : 'Usuário não encontrado';
        $request->sector_name = ($request->user && $request->user->sector) ? $request->user->sector->name : 'Setor não encontrado';

        unset($request->idProduct);
        unset($request->idUser);
        unset($request->product);
        unset($request->user);

        return response()->json($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::all();
        $users = User::all();
        $request = RequestModel::findOrFail($id);
        return view('requests.edit', compact('request', 'products', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestion = RequestModel::find($id);
        
        if (!$requestion) {
            return response()->json(['message' => 'Requisição não encontrado'], 404);
        }
        
        $requestion->status = 'aceito'; 
        $requestion->save();
        
        return response()->json([
            'message' => 'Requisição atualizada com sucesso',
            'movement' => $requestion
        ], 200);
    }


    public function destroy(string $id, DeleteRequest $deleteRequest)
    {
        try {
            $this->deleteRequest->execute($id);
            return response()->json(['message' => 'Pedido excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o pedido: ' . $e->getMessage()], 500);
        }
    }
}
