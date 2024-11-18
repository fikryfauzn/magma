@extends('layouts.app')

@push('styles')
    @vite(['resources/css/payment.css'])
@endpush


@section('content')
<div class="payment-section">
    <h1>Complete Your Payment</h1>
    <p>Order ID: ORDER-{{ $transaction->transaction_id }}</p>
    <p>Total Amount: $ {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
    <p>Virtual Account Number: {{ $transaction->virtual_account_number }}</p>
    <p>Please make the payment to the above virtual account number.</p>
</div>
@endsection
