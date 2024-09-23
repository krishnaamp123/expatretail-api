<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::all();
        // return response()->json(['data' => $order]);
        return OrderResource::collection($order);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return new OrderResource($order);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_customer_product' => 'required',
            'qty' => 'required',
            'total_price' => 'required',
        ]);

        $order = Order::create($request->all());
        return new OrderResource($order);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_customer_product' => 'required',
            'qty' => 'required',
            'total_price' => 'required',
        ]);

        $order = Order::findorFail($id);
        $order->update($request->all());
        return new OrderResource($order);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return new OrderResource($order);
    }
}
