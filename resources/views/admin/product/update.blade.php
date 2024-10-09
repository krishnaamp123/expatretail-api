@extends('admin.layout.app')
@section('title', 'Edit Product')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Product</h1>
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Product Form</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateProduct', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- To indicate that this is a PUT request for updating -->

                        <div class="form-group">
                            <label>Packaging ID</label>
                            <input type="number" name="id_packaging" class="form-control" value="{{ old('id_packaging', $product->id_packaging) }}">
                            @error('id_packaging')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}">
                            @error('product_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Current Image</label><br>
                            @if ($product->image)
                                <img src="{{ asset('storage/image/' . $product->image) }}" alt="Product Image" width="100" height="100">
                            @else
                                <span>No Image Available</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>New Image (Optional)</label>
                            <input type="file" name="file" class="form-control">
                            @error('file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                        <a href="{{ route('getProduct') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
