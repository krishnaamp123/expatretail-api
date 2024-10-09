@extends('admin.layout.app')
@section('title', 'Add Packaging')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Packaging</h1>
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Packaging Form</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('storePackaging') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Packaging Name</label>
                            <input type="text" name="packaging_name" class="form-control">
                            @error('packaging_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="number" name="weight" class="form-control">
                            @error('weight')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
