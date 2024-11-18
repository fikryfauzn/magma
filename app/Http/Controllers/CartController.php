<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;



class CartController extends Controller
{


    
    // View Cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }



    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        // Add a check to make sure you're not attempting to get a product with ID 1
        if ($productId == 1) {
            return redirect()->route('cart.index')->with('error', 'Invalid product selected.');
        }
    
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);
    
        if (isset($cart[$product->product_id])) {
            // If product already in cart, increment quantity
            $cart[$product->product_id]['quantity'] += $request->input('quantity');
        } else {
            // Add new product to cart
            $cart[$product->product_id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->input('quantity'),
                'image' => $product->image,
            ];
        }
    
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }
    


    // Update Cart Item Quantity
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->input('quantity');
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
    }

    // Remove Cart Item
    public function destroy($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
    }
}
