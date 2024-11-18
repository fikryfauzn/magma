@extends('layouts.app')

@push('styles')
    @vite(['resources/css/cart.css'])
@endpush

@section('content')
<div class="cart-section">
    <h1>Your Cart</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (!empty($cart) && count($cart) > 0)
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="cart-quantity-input">
                        </td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="cart-actions-container">
                            <!-- Update Quantity -->
                            <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="quantity" value="{{ $item['quantity'] }}">
                                <button type="submit" class="btn btn-update">Update</button>
                            </form>

                            <!-- Remove Item -->
                            <form action="{{ route('cart.destroy', $id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Checkout Button -->
        <div class="checkout-button-container">
            <a href="{{ route('checkout.index') }}" class="btn btn-checkout">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty!</p>
    @endif
</div>
@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach event listener to all 'Update' buttons
        const updateForms = document.querySelectorAll('.update-form');
        updateForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get product ID from the form's context
                const productId = form.action.split('/').pop(); // Extract ID from form action URL
                const quantityInput = document.querySelector(`input[data-product-id="${productId}"]`);

                // Update the hidden quantity input before submitting the form
                const hiddenQuantityInput = document.createElement('input');
                hiddenQuantityInput.type = 'hidden';
                hiddenQuantityInput.name = 'quantity';
                hiddenQuantityInput.value = quantityInput.value;

                form.appendChild(hiddenQuantityInput);

                // Submit the form after updating the hidden input value
                form.submit();
            });
        });
    });
</script>
@endpush
