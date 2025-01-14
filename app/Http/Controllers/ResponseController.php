<?php

namespace App\Http\Controllers;

use App\Models\Response; // Certifique-se de que o modelo Response existe
use Illuminate\Http\Request;
use App\UseCases\Response\CreateResponse;
use App\UseCases\Response\UpdateResponse;
use App\UseCases\Response\DeleteResponse;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados = Response::all();
        return view('response.index', compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('response.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateResponse $createResponse)
    {
        $validated = $request->validate([
            'idResponse' => 'required|integer', 
            'isValid' => 'required|boolean',
            'response' => 'required|string|max:255', 
        ]);

        $createResponse->execute($validated);

        return redirect()->route('response.index')->with('success', 'Resposta criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Response::findOrFail($id);
        return view('response.show', compact('response'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = Response::findOrFail($id);
        return view('response.edit', compact('response'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, UpdateResponse $updateResponse)
    {
        $validated = $request->validate([
            'response' => 'required|string|max:255', 
        ]);

        $response = Response::findOrFail($id);

        $updateResponse->execute($response, $validated);

        return redirect()->route('response.index')->with('success', 'Resposta atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteResponse $deleteResponse)
    {
        $deleteResponse->execute($id);

        return redirect()->route('response.index')->with('success', 'Resposta excluída com sucesso!');
    }
}
