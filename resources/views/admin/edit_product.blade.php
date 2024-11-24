<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit product</h2>

        <form action="{{ route('admin.product.update', $product->product_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_id">Product ID</label>
                <input type="text" name="product_id" value="{{ $product->product_id }}" class="form-control" id="product_id">
            </div>

            <div>
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ $product->name }}" required>
            </div>

            <div>
                <label for="price">Price</label>
                <input type="text" id="price" name="price" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <label for="product_id">Product ID</label>
                <input type="text" name="product_id" value="{{ $product->product_id }}" class="form-control" id="product_id">
            </div>

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ $product->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" value="{{ $product->price }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                <small class="form-text text-muted">Upload product image</small>
            </div>

            <div class="form-group">
                <label for="tracking_id">Tracking ID</label>
                <input type="text" id="tracking_id" name="tracking_id" value="{{ $product->tracking_id }}" class="form-control">
            </div>


            <button type="submit" class="btn btn-primary">Update product</button>
        </form>
        <form action="{{ route('admin.products.edit', $product->product_id) }}" method="GET" style="display:inline;">
    @csrf
    <button type="submit" class="update-button">Edit</button>
</form>

    </div>
</body>
</html>

