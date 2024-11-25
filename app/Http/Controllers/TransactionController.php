<?php
use App\Models\Transaction;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::paginate(10);
        return view('admin.transaction', compact('transactions'));
    }

    // Method untuk menampilkan halaman edit transaksi
    public function edit($id)
    {
    // Ambil data transaksi berdasarkan ID
    $transaction = Transaction::findOrFail($id);

    // Kembalikan view dengan data transaksi
    return view('admin.edit.edittransaction', compact('transaction'));
    }

    // Method untuk mengupdate transaksi
    public function update(Request $request, $id)
{
    // Temukan transaksi berdasarkan ID
    $transaction = Transaction::find($id);

    // Jika transaksi tidak ditemukan, redirect ke halaman daftar transaksi dengan pesan error
    if (!$transaction) {
        return redirect()->route('admin.transactions')->with('error', 'Transaction not found.');
    }

    // Update data transaksi
    $transaction->product_id = $request->product_id;
    $transaction->user_id = $request->user_id;
    $transaction->total_amount = $request->total_amount;
    // Tambahkan field lain sesuai kebutuhan

    // Simpan perubahan
    $transaction->save();

    // Redirect kembali ke halaman daftar transaksi setelah berhasil update
    return redirect()->route('admin.transactions')->with('success', 'Transaction updated successfully');
}



    public function destroy($id)
    {
    try {
            // Cari transaksi berdasarkan ID
            $transaction = Transaction::findOrFail($id);

            // Hapus transaksi
            $transaction->delete();

            // Redirect kembali ke halaman admin transaksi tanpa ID
            return redirect()->route('admin.transactions')->with('success', 'Transaction deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.transactions')->with('error', 'Failed to delete transaction.');
        }
    }

}
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->user_id)->get();
        
        return view('transactions.index', compact('transactions'));
    }
}