@extends('admin.layout.app')
@section('title', 'Edit Packaging')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Packaging</h1>
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Packaging Form</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('updatePackaging', $packaging->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Packaging Name</label>
                            <input type="text" name="packaging_name" class="form-control" value="{{ old('packaging_name', $packaging->packaging_name) }}">
                            @error('packaging_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Weight</label>
                            <input type="number" name="weight" class="form-control" value="{{ old('weight', $packaging->weight) }}">
                            @error('weight')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                        <a href="{{ route('getPackaging') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
