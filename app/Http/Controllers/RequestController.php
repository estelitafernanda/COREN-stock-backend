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

     // Declare a variável para o CreateRequest
     private $createRequest;

     // Injeção de dependência no construtor
     public function __construct(CreateRequest $createRequest)
     {
         // Atribuindo o serviço CreateRequest à propriedade
         $this->createRequest = $createRequest;
     }
 

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados = RequestModel::all();
        return view('requests.index', compact('dados'));
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
        $request = RequestModel::findOrFail($id);
        return view('requests.edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, UpdateRequest $updateRequest)
    {
        $requestData = RequestModel::findOrFail($id);

        $validated = $request->validate([
            'idRequest' => 'required|integer|unique:requests,idRequest,' . $id,
            'idProduct' => 'required|integer|unique:requests,idProduct',
            'describe' => 'required|string|max:255',
            'requestDate' => 'required|date',
            'quantity' => 'required|integer|min:1',
        ]);

        $updateRequest->execute($requestData, $validated);

        return redirect()->route('requests.index')->with('success', 'Requisição atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteRequest $deleteRequest)
    {
        $deleteRequest->execute($id);

        return redirect()->route('requests.index')->with('success', 'Requisição excluída com sucesso!');
    }
}
