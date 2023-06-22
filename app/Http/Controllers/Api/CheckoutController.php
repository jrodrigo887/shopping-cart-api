<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Products;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $checkout;
    function __construct(Checkout $checkouts)
    {
        $this->checkout = $checkouts;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ckts = $this->checkout::withd('products')->get();
        return response()->json($ckts);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ckt = $this->checkout::with('products')->find($id);

        if (!$ckt) {
            return response()->json(['message' => 'Checkout não encontrado'], 404);
        }

        return response()->json($ckt, 200);


        // $products[] = $checkout->getAssociatedProducts();

        // if (!$products) {
        //     return response()->json(['message' => 'sem produtos'], 404);
        // }

        // return response()->json(['checkout' => $checkout, 'products' => $products], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkout::created($request->all());
        return response()->json(['message'=> 'Carrrinho Criado com sucesso.'], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->checkout::find($id);
        $data->update($request->all());

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->checkout::destroy($id);
        return response()->json(['message' => 'Checkout deleted']);
    }

    public function addProducts(Request $request, $checkoutId) {
        $checkout = $this->checkout::find($checkoutId);

        if (!$checkout) {
            return response()->json(['message' => 'Checout não encontrado'], 404);
        }

        $products = $request->input('products',[]);
        foreach ($products as $prod) {
            $checkout->products()->created($prod);
        }

        // $checkout->products()->saveMany($products);
        return response()->json(['message' => 'Produtos adicionados com sucesso', 'products'=> $products]);
    }
    public function removeProduct(Request $request, $checkoutId, $productId) {

        $checkout = $this->checkout::find($checkoutId);
        if (!$checkout) {
            return response()->json(['message' => 'Checkout não encontrado'], 404);
        }

        $product = $this->checkout->products()->find($productId);
        if (!$product) {
            return response()->json(['message' => 'produto não encontrado.'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Produtos removido com sucesso']);
    }
}
