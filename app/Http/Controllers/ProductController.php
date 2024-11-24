<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Return the 'catalog' view with the products data
        return view('catalog', compact('products'));
    }

    public function showproductindex()
    {
        // Ambil semua produk dari tabel
        $products = Product::paginate(10); // Menampilkan 10 produk per halaman

        return view('admin.manage_product', compact('products')); // Kirim data ke view
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

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Cari produk berdasarkan ID
        return view('admin.edit_product', compact('product')); // Kirim data produk ke view
    }

    public function destroy($id)
    {
        try {
            // Cari produk berdasarkan ID
            $product = Product::findOrFail($id);

            // Hapus produk
            $product->delete();

            // Redirect setelah berhasil menghapus produk
            return redirect()->route('admin.manage_product')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.manage_product')->with('error', 'Failed to delete product');
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Update data produk
        $product->name = $request->name;
        $product->price = $request->price;
        // Tambahkan validasi dan field lainnya sesuai kebutuhan

        // Simpan perubahan
        $product->save();

        // Redirect ke halaman manage_product setelah update
        return redirect()->route('admin.manage_product')->with('success', 'Product updated successfully');
    }




}
