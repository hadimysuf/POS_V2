<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil data produk dari database
        $products = [
            ['id' => 1, 'name' => 'Product A', 'price' => 10000],
            ['id' => 2, 'name' => 'Product B', 'price' => 20000],
        ];

        return view('admin.products.index', compact('products'));
    }
}
