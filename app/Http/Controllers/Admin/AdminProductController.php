<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function getProduct()
    {
        return view('admin.product.product', [
            'product' => Product::latest()->get()
        ]);
    }
}
