@extends('layouts.admin')
@vite(['resources/css/notification-profile.css'])
@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $product->name }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description">{{ $product->description }}</textarea>
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" name="price" value="{{ $product->price }}" required>
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
