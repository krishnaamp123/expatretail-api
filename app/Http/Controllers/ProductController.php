<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        // return response()->json(['data' => $product]);
        return ProductResource::collection($product);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_packaging' => 'required',
            'product_name' => 'required|max:100',
            'description' => 'required',
        ]);

        $image = null;
        if($request->file){
            $filename = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $filename.'.'.$extension;

            Storage::putFileAs('image', $request->file, $image);
        }

        $request['image'] = $image;
        $product = Product::create($request->all());
        return new ProductResource($product);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_packaging' => 'required',
            'product_name' => 'required|max:100',
            'description' => 'required',
        ]);

        $product = Product::findorFail($id);
        $product->update($request->all());
        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }

    function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
