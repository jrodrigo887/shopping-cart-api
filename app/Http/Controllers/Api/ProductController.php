<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Products::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name'=> 'required|max:255',
            'description'=> 'nullable',
            'price'=> 'required|numeric|min:0',
            'checkout_id'=> 'nullable',
        ]);

        $product = Products::create([
            'name' => $validData['name'],
            'description' => $validData['description'] ?? '',
            'price' => $validData['price'],
            'checkout_id' => $validData['checkout_id'] ?? null,
        ]);


        return response()->json(['message'=> 'Produto criado com sucesso.', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prod = Products::find($id);
        return response()->json($prod);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = Products::find($id);

        if (!$product) {
            return response()->json(['message'=> 'Produto não encontrado'], 404);
        }

        $validData = $request->validate([
            'name'=> 'required|max:255',
            'description'=> 'nullable',
            'price'=> 'required|numeric|min:0',
            'checkout_id'=> 'nullable',
        ]);

        $product->update([
            'name' => $validData['name'],
            'description' => $validData['description'] ?? '',
            'price' => $validData['price'],
            'checkout_id' => $validData['checkout_id'] ?? null,
        ]);

        // $products->update($validData);
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Products::destroy($id);
        return response()->json(['message'=> 'Produto deletado com sucesso.'], 200);
    }
}
