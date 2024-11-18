<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Return the 'catalog' view with the products data
        return view('catalog', compact('products'));
    }
    
    // Show the form for creating a new product
    public function create()
    {
        return view('admin.create_product');
    }

    public function show($slug)
    {

        $product = Product::where('slug', $slug)->firstOrFail();

    // Check the slug and return the specific blade file for each product
        if ($slug === 'grove') {
        return view('products.grove', compact('product'));
        }

        // Return a view for the product
        return view('products.show', compact('product'));
    }

    public function showGuide()
    {
        $products = Product::all(); // Fetch all products
        return view('guide', compact('products'));
    }




    // Store a new product in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            'tracking_id' => 'nullable|integer'
        ]);

        // Handle image upload if it exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create the product in the database
        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $imagePath,
            'tracking_id' => $request->input('tracking_id')
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.products.create')->with('success', 'Product created successfully');
    }
}
