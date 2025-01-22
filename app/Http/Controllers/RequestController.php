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
 

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maxQnt = 4;

        $requests = RequestModel::with(['product', 'user'])->paginate($maxQnt);

        $requests->getCollection()->transform(function($request) {
            $request->product_name = $request->product ? $request->product->nameProduct : 'Produto não encontrado';
            $request->user_name = $request->user ? $request->user->nameUser : 'Usuário não encontrado';
            $request->sector_name = ($request->user && $request->user->sector) ? $request->user->sector->name : 'Setor não encontrado';

            unset($request->idProduct);
            unset($request->idUser);
            unset($request->product);
            unset($request->user);

            return $request;
        });

        return response()->json($requests);
            // $dados = RequestModel::all();
            // return view('requests.index', compact('dados'));
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
            $this->createRequest->execute($request->all());
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
        $request = RequestModel::findOrFail($id);
        return view('requests.show', compact('request'));
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
    public function update(Request $request, string $id, UpdateRequest $updateRequest)
    {
        try {
            $requestion = RequestModel::findOrFail($id);
    
            $this->updateRequest->execute($id, $request->all());
    
            return redirect()->route('requests.index')->with('success', 'Pedido atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar o pedido: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteRequest $deleteRequest)
    {
        try {
            $this->deleteRequest->execute($id);
            return redirect()->route('requests.index')->with('success', 'pedido excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir o pedido: ' . $e->getMessage());
        }
    }
}
