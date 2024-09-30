<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    public function index()
    {
        $customerId = auth()->id();
        $cart = Cart::where('id_customer', $customerId)->get();
        return CartResource::collection($cart);
    }

    public function show($id)
    {
        $cart = Cart::findOrFail($id);
        return new CartResource($cart);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_customer' => 'required',
            'id_customer_product' => 'required',
            'qty' => 'required',
        ]);

        $cart = Cart::create($request->all());
        return new CartResource($cart);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_customer' => 'required',
            'id_customer_product' => 'required',
            'qty' => 'required',
        ]);

        $cart = Cart::findorFail($id);
        $cart->update($request->all());
        return new CartResource($cart);
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return new CartResource($cart);
    }
}
