<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestModel;
use App\UseCases\Request\CreateRequest;
use App\UseCases\Request\UpdateRequest;
use App\UseCases\Request\DeleteRequest;

class RequestController extends Controller
{
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
        return view('requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateRequest $createRequest)
    {
        $validated = $request->validate([
            'idRequest' => 'required|integer|unique:requests,idRequest',
            'idProduct' => 'required|integer|unique:requests,idProduct',
            'idUser' => 'required|integer|unique:requests,idUser',
            'describe' => 'required|string|max:255',
            'requestDate' => 'required|date',
            'quantity' => 'required|integer|min:1',
        ]);

        $createRequest->execute($validated);

        return redirect()->route('requests.index')->with('success', 'Requisição criada com sucesso!');
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
