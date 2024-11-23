<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction</title>
    <link rel="stylesheet" href="{{ asset('css/transaction.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Transaction</h2>

        <form action="{{ route('admin.transactions.update', $transaction->transaction_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_id">Product ID</label>
                <input type="text" name="product_id" value="{{ $transaction->product_id }}" class="form-control" id="product_id">
            </div>

            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="text" name="user_id" value="{{ $transaction->user_id }}" class="form-control" id="user_id">
            </div>

            <div class="form-group">
                <label for="serviceBooking">Service Booking</label>
                <input type="text" name="serviceBooking" value="{{ $transaction->serviceBooking->name ?? 'N/A' }}" class="form-control" id="serviceBooking">
            </div>

            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="text" name="total_amount" value="{{ $transaction->total_amount }}" class="form-control" id="total_amount">
            </div>

            <div class="form-group">
                <label for="transaction_type">Transaction Type</label>
                <input type="text" name="transaction_type" value="{{ $transaction->transaction_type }}" class="form-control" id="transaction_type">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" value="{{ $transaction->status }}" class="form-control" id="status">
            </div>

            <div class="form-group">
                <label for="transaction_date">Transaction Date</label>
                <input type="date" name="transaction_date" value="{{ $transaction->transaction_date }}" class="form-control" id="transaction_date">
            </div>

            <button type="submit" class="btn btn-primary">Update Transaction</button>
        </form>
        <form action="{{ route('admin.transactions.edit', $transaction->transaction_id) }}" method="GET" style="display:inline;">
    @csrf
    <button type="submit" class="update-button">Edit</button>
</form>

    </div>
</body>
</html>
