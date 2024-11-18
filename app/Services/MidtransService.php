<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;

class MidtransService
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($orderId, $grossAmount, $customerDetails)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => $customerDetails,
            // You can add more configurations like shipping address, etc.
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showPaymentPage()
    {
        // Assume order details are retrieved here
        $order = Order::find(session('order_id'));

        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Order not found.');
        }

        // Snap API configuration
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'last_name' => '',
                'email' => $order->email,
                'phone' => $order->phone,
            ],
        ];

        // Generate Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Render the payment view with the token
        return view('checkout.payment', compact('snapToken', 'order'));
    }
}
