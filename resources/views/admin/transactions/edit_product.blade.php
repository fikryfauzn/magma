<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    
    <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" required>
        </div>
        
        <div>
            <label for="price">Price</label>
            <input type="text" id="price" name="price" value="{{ $product->price }}" required>
        </div>
        
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
