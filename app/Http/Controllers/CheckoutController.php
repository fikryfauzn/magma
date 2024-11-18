<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Mail\PHPMailerService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

     // Show the checkout form
     public function index()
     {
         $cart = session()->get('cart', []);
         
         if (empty($cart)) {
             return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
         }
 
         return view('checkout.index', compact('cart'));
     }
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        $totalAmount = 0;

        // Calculate total amount
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Generate a random virtual account number
        $virtualAccountNumber = 'VA-' . rand(1000000000, 9999999999); // Example: Generate random VA

        // Store the transaction details
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'Pending',
            'payment_method' => 'Virtual Account',
            'shipping_address' => $request->input('address'),
            'virtual_account_number' => $virtualAccountNumber,
        ]);

        // Send email to the customer
        $user = Auth::user(); // Get the authenticated user
        $emailService = new PHPMailerService();
        $emailBody = "Hello " . $user->name . ",<br><br>Your order with Order ID: " . $transaction->transaction_id . " has been received. Please proceed to payment using the virtual account number: " . $transaction->virtual_account_number . "<br><br>Thank you!";
        
        $emailSent = $emailService->sendEmail($user->email, 'Your Order Confirmation', $emailBody);

        // Check if email was successfully sent
        if (!$emailSent) {
            return redirect()->route('checkout.index')->with('error', 'There was an issue sending the confirmation email.');
        }

        // Clear the cart
        session()->forget('cart');

        // Redirect to the payment page
        return redirect()->route('checkout.payment', $transaction->transaction_id);
    }

    public function paymentPage($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        return view('checkout.payment', compact('transaction'));
    }

    public function confirmPayment($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        if ($transaction->status !== 'Pending') {
            return redirect()->route('home')->with('error', 'This transaction has already been processed.');
        }

        // Update transaction status to complete
        $transaction->update([
            'status' => 'Completed'
        ]);

        return redirect()->route('home')->with('success', 'Thank you! Your payment has been confirmed.');
    }
}
