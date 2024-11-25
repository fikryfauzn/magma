<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Mail\PHPMailerService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private $baseVA = '22770891'; // Nomor VA dasar yang diberikan oleh bank (contoh)

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

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totalAmount = 0;
        $productId = null;
        $quantity = 0;

        // Calculate total amount, get the first product ID, and get the quantity
        foreach ($cart as $key => $item) {
            $totalAmount += $item['price'] * $item['quantity'];
            if ($productId === null) {
                $productId = $key; // Since the cart key is the product_id
                $quantity = $item['quantity']; // Get the quantity of the first product in the cart
            }
        }

        if (is_null($productId)) {
            return redirect()->route('cart.index')->with('error', 'Product information is missing from your cart.');
        }

        Log::info("Proceeding to checkout for Product ID $productId, Quantity $quantity, Total Amount $totalAmount");


        // Generate a reference number
        $referenceNumber = 'REF-' . strtoupper(uniqid());

        // Determine the transaction type
        $transactionType = isset($request->service_booking) && $request->service_booking ? 'ServiceBooking' : 'ProductPurchase';

        // Store the transaction details, including quantity
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'quantity' => $quantity,
            'total_amount' => $totalAmount,
            'status' => 'Pending',
            'shipping_address' => $request->input('address'),
            'transaction_type' => $transactionType,
            'transaction_date' => now(), // Set current timestamp as transaction date
            'reference_number' => $referenceNumber, // Store the generated reference number
        ]);

        // Generate a VA number using Semi Dynamic VA approach
        $transactionExtension = str_pad($transaction->transaction_id, 3, '0', STR_PAD_LEFT); // Misalnya menambahkan 3 digit nomor urut berdasarkan transaction_id
        $virtualAccountNumber = $this->baseVA . $transactionExtension;

        // Update the transaction with the generated VA number
        $transaction->update([
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
