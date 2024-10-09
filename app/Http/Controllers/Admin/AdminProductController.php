<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function getProduct()
    {
        return view('admin.product.index', [
            'product' => Product::latest()->get()
        ]);
    }

    public function addProduct()
    {
        return view('admin.product.store');
    }

    public function storeProduct(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'id_packaging' => 'required',
            'product_name' => 'required|max:100',
            'description' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        $image = null;
        if ($request->hasFile('file')) {
            $filename = $this->generateRandomString();
            $extension = $request->file('file')->getClientOriginalExtension();
            $image = $filename . '.' . $extension;

            // Store the image in the 'public/image' directory
            $request->file('file')->storeAs('public/image', $image);
        }

        // Create the product record in the database
        Product::create([
            'id_packaging' => $request->id_packaging,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'image' => $image,
        ]);

        // Redirect with success message
        return redirect()->route('getProduct')->with('message', 'Data Added Successfully');
    }

    // Helper method to generate a random string for the file name
    function generateRandomString($length = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function editProduct($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Return the edit view with the product data
        return view('admin.product.update', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Validate the input data
        $validated = $request->validate([
            'id_packaging' => 'required',
            'product_name' => 'required|max:100',
            'description' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        // Check if a new image file is uploaded
        if ($request->hasFile('file')) {
            // Generate a new filename for the uploaded image
            $filename = $this->generateRandomString();
            $extension = $request->file('file')->getClientOriginalExtension();
            $image = $filename . '.' . $extension;

            // Store the new image in the 'public/image' directory
            $request->file('file')->storeAs('public/image', $image);

            // Delete the old image if it exists
            if ($product->image) {
                Storage::delete('public/image/' . $product->image);
            }

            // Update the product's image with the new filename
            $product->image = $image;
        }

        // Update other product fields
        $product->id_packaging = $request->id_packaging;
        $product->product_name = $request->product_name;
        $product->description = $request->description;

        // Save the updated product to the database
        $product->save();

        // Redirect with success message
        return redirect()->route('getProduct')->with('message', 'Product Updated Successfully');
    }

    public function destroyProduct($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->image) {
            Storage::delete('public/image/' . $product->image); // Pastikan ada garis miring
        }

        // Hapus produk dari database
        $product->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('getProduct')->with('message', 'Product deleted successfully');
    }

}
