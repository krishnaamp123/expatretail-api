@extends('admin.layout.app')
@section('title', 'Add User')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">User</h1>
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add User Form</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('storeUser') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>ID Company</label>
                            <select name="id_group" class="form-control select2">
                                <option value="">Select Company</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->company_name }}</option>
                                @endforeach
                            </select>
                            @error('id_group')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" name="customer_name" class="form-control">
                            @error('customer_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>PIC Name</label>
                            <input type="text" name="pic_name" class="form-control">
                            @error('pic_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>PIC Phone</label>
                            <input type="number" name="pic_phone" class="form-control">
                            @error('pic_phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="retail">Retail</option>
                                <option value="supermarket">Supermarket</option>
                            </select>
                            @error('role')
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
