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
        return $this->checkout::all();
    }

    public function addProductsTocheckout(Request $request, $checkoutId) {
        $checkout = Checkout::find($checkoutId);

        if (!$checkout) {
            return response()->json(['message' => 'Checout não encontrado'], 404);
        }

        $prodsData = $request->input('products',[]);

        $products = [];
        foreach ($prodsData as $prod) {
            $product = new Products($prod);
            $products[] = $product;
        }

        $checkout->products()->saveMany($products);
        return response()->json(['message' => 'Produtos adicionados com sucesso'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $checkout = Checkout::find($id);

        if (!$checkout) {
            return response()->json(['message' => 'Checkout não encontrado'], 404);
        }

        $products[] = $checkout->getAssociatedProducts();

        if (!$products) {
            return response()->json(['message' => 'sem produtos'], 404);
        }

        return response()->json(['checkout' => $checkout, 'products' => $products], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
