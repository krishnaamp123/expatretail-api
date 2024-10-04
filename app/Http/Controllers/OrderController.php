<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index()
{
    $customerId = auth()->id();

    // Mengambil semua order dengan relasi 'customer' dan 'details' untuk user yang sedang login
    $orders = Order::with(['customer.company', 'details'])
                ->where('id_customer', $customerId)
                ->get(); // Mengganti all() dengan get()

    return OrderResource::collection($orders);
}

    public function show($id)
    {
        $order = Order::with(['customer', 'details'])->findOrFail($id);
        return new OrderResource($order);
    }

    // public function store(Request $request)
    // {
    //     // dd ($request);
    //     $validated = $request->validate([
    //         'id_customer' => 'required',
    //         'details' => 'required|array',
    //         // 'details.*' => 'json',
    //         'total_price' => 'required',
    //         // 'carts.*' => 'exists:carts, id',
    //     ]);
    //     $order = Order::create($request->all());
    //     $details = array_map(function($value) use ($request, $order){
    //         // $cart = Cart::find($value);
    //         // $value = json_decode($value);
    //         // dd (json_decode($value));
    //         return ['id_order'=>$order->id, 'id_cart'=>$value['id'], 'qty'=>$value['qty'], 'price'=>$value['price']];
    //     }, $request->details);
    //     DetailOrder::insert($details);
    //     return new OrderResource($order);
    // }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_customer' => 'required|exists:users,id',
            'details' => 'required|array',
            'details.*.id' => 'required|exists:carts,id',  // Memastikan setiap detail memiliki 'id_cart' yang valid
            'details.*.qty' => 'required|integer',
            'details.*.price' => 'required|numeric',
            'total_price' => 'required|numeric',
        ]);

        // Membuat order
        $order = Order::create([
            'id_customer' => $request->id_customer,
            'total_price' => $request->total_price,
        ]);

        // Memproses details array dan memasukkannya ke tabel DetailOrder
        $details = array_map(function ($value) use ($order) {
            return [
                'id_order' => $order->id,
                'id_cart' => $value['id'],
                'qty' => $value['qty'],
                'price' => $value['price']
            ];
        }, $request->details);

        // Simpan ke tabel DetailOrder
        DetailOrder::insert($details);

        // Mengembalikan respons
        return new OrderResource($order);
    }

    public function update(Request $request, $id)
    {
        // Validasi input yang diterima
        $validated = $request->validate([
            'id_customer' => 'required|exists:users,id',
            'details' => 'required|array',
            'details.*.id' => 'required|exists:carts,id',
            'details.*.qty' => 'required|integer',
            'details.*.price' => 'required|numeric',
            'total_price' => 'required|numeric',
        ]);

        // Mencari order yang akan di-update
        $order = Order::findOrFail($id);

        // Update order utama
        $order->update([
            'id_customer' => $request->id_customer,
            'total_price' => $request->total_price,
        ]);

        // Hapus detail order lama
        DetailOrder::where('id_order', $order->id)->delete();

        // Masukkan details baru
        $details = array_map(function ($value) use ($order) {
            return [
                'id_order' => $order->id,
                'id_cart' => $value['id'],
                'qty' => $value['qty'],
                'price' => $value['price'],
            ];
        }, $request->details);

        // Insert details yang baru
        DetailOrder::insert($details);

        // Mengembalikan order yang diupdate
        return new OrderResource($order);
    }

    public function destroy($id)
    {
        // Mencari order yang akan dihapus
        $order = Order::findOrFail($id);

        // Hapus semua detail yang berhubungan dengan order
        DetailOrder::where('id_order', $order->id)->delete();
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully.'], 200);
    }
}
