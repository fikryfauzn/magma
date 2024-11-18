<?php

namespace App\Http\Controllers;

use App\Models\Product;

class GuideController extends Controller
{
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass the products to the guide view
        return view('guide', compact('products'));
    }
}
