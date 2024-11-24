@extends('layouts.app')

@push('styles')
    @vite(['resources/css/transactions.css'])
@endpush

@section('content')
<div class="transactions-section">
    <h1>Your Transactions</h1>
    @if($transactions->isEmpty())
        <p>You have no transactions yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->transaction_id }}</td>
                        <td>{{ $transaction->product->name ?? 'N/A' }}</td>
                        <td>{{ $transaction->quantity }}</td> <!-- Assuming 'quantity' column exists in transactions -->
                        <td>{{ $transaction->transaction_date }}</td>
                        <td>${{ number_format($transaction->total_amount, 2) }}</td>
                        <td>{{ ucfirst($transaction->status) }}</td>
                        <td>
                            <a href="{{ route('checkout.payment', $transaction->transaction_id) }}">View Payment Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@push('scripts')
    @vite(['resources/js/transactions.js'])
@endpush
