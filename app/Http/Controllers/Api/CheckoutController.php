<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Products;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ckts = Checkout::with('products')->get();
        return response()->json($ckts);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ckt = Checkout::with('products')->find($id);

        if (!$ckt) {
            return response()->json(['message' => 'Checkout não encontrado'], 404);
        }

        return response()->json($ckt, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Checkout::created($request->all());
        return response()->json(['message'=> 'Carrrinho Criado com sucesso.'], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Checkout::find($id);
        $data->update($request->all());

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Checkout::destroy($id);
        return response()->json(['message' => 'Checkout deleted'], 204);
    }

    public function addProducts(Request $request, $checkoutId) {
        $checkout = Checkout::find($checkoutId);

        if (!$checkout) {
            return response()->json(['message' => 'Checout não encontrado'], 404);
        }

        $products = $request->input('products',[]);
        foreach ($products as $prod) {
            $product = Products::find($prod['id']);
            if ($product) {
                $product->update([
                    'name' => $prod['name'],
                    'description' => $prod['description'],
                    'price' => $prod['price'],
                    'checkout_id' => $checkoutId ?? null,
                ]);
             } else {
                $checkout->products()->create([
                    'name' => $prod['name'],
                    'description' => $prod['description'],
                    'price' => $prod['price'],
                    'checkout_id' => $checkoutId ?? null,
                ]);
             }
        }

        return response()->json(['message' => 'Produtos adicionados com sucesso', 'products'=> $products]);
    }
    public function removeProduct(Request $request, $checkoutId, $productId) {

        $checkout = Checkout::find($checkoutId);
        if (!$checkout) {
            return response()->json(['message' => 'Checkout não encontrado'], 404);
        }

        $product = $checkout->products()->find($productId);
        if (!$product) {
            return response()->json(['message' => 'produto não encontrado.'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Produtos removido com sucesso']);
    }
}
