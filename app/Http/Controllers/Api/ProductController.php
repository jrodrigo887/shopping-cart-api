<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    function __construct(Products $products)
    {
        $this->product = $products;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->product::all());
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

        $this->product::created($validData);
        return response()->json(['message'=> 'Produto criado com sucesso.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prod = $this->product::find($id);
        return response()->json($prod);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validData = $request->validate([
            'name'=> 'required|max:255',
            'description'=> 'nullable',
            'price'=> 'required|numeric|min:0',
            'checkout_id'=> 'nullable',
        ]);

        $this->product::updated($validData);
        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->product::destroy($id);
        return response()->json(['message'=> 'Produto deletado com sucesso.'], 200);
    }
}
