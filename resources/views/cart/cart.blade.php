<form action="{{ route('cart.clear') }}" method="POST" style="display: inline-block;">
    @csrf
    <button type="submit" class="btn btn-danger">Clear Cart</button>
</form>
