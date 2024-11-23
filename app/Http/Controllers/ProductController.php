<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        // Ambil semua produk dari tabel
        $products = Product::paginate(10); // Menampilkan 10 produk per halaman

        return view('admin.manage_product', compact('products')); // Kirim data ke view
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        return view('admin.create_product'); // Menampilkan halaman form pembuatan produk
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Cari produk berdasarkan ID
        return view('admin.edit_product', compact('product')); // Kirim data produk ke view
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id); // Cari produk berdasarkan ID
        $product->delete(); // Hapus produk dari database

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }


}
