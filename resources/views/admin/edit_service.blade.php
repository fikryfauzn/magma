

@section('content')
    <h1>Edit Service</h1>

    <form action="{{ route('admin.services.update', $service->service_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" id="service_name" name="service_name" class="form-control" value="{{ old('service_name', $service->service_name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required>{{ old('description', $service->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $service->price) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
