<?php

namespace App\Http\Controllers;

use App\Models\CustomerProduct;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerProductResource;

class CustomerProductController extends Controller
{
    public function index()
    {
        $customerId = auth()->id();
        $customerproduct = CustomerProduct::where('id_customer', $customerId)->get();
        // $customerproduct = CustomerProduct::all();
        // return response()->json(['data' => $customerproduct]);
        return CustomerProductResource::collection($customerproduct);
    }

    public function show($id)
    {
        $customerproduct = CustomerProduct::findOrFail($id);
        return new CustomerProductResource($customerproduct);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_customer' => 'required',
            'id_product' => 'required',
            'price' => 'required',
        ]);

        $customerproduct = CustomerProduct::create($request->all());
        return new CustomerProductResource($customerproduct);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_customer' => 'required',
            'id_product' => 'required',
            'price' => 'required',
        ]);

        $customerproduct = CustomerProduct::findorFail($id);
        $customerproduct->update($request->all());
        return new CustomerProductResource($customerproduct);
    }

    public function destroy($id)
    {
        $customerproduct = CustomerProduct::findOrFail($id);
        $customerproduct->delete();
        return response()->json(['message' => 'CustomerProduct deleted successfully.'], 200);
    }
}
