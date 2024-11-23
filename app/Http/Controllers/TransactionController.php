<?php

// app/Http/Controllers/TransactionController.php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        // Ambil data transaksi dengan pagination dan relasi dengan ServiceBooking
        $transactions = Transaction::with('serviceBooking') // Pastikan relasi serviceBooking dimuat
            ->paginate(10); // Menampilkan 10 transaksi per halaman

        // Kirim data transaksi ke view
        return view('admin.transaction', compact('transactions'));
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('admin.edit_transaction', compact('transaction'));
    }

    public function update(Request $request, $transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);

        // Validate the request data
        $validated = $request->validate([
            'status' => 'required|string',
            // Add other fields you want to update here
        ]);

        // Update the transaction with validated data
        $transaction->update($validated);

        // Redirect or return a response
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.transactions')->with('success', 'Transaction deleted successfully.');
    }
}
