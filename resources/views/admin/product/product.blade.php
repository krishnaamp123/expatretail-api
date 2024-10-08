@extends('admin.layout.app')
@section('title', 'product')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product</h1>
    <p class="mb-3">Master data product item retail</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="fa-sm text-center">
                            <th>ID</th>
                            <th>Packaging ID</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $row)
                        <tr class="fa-sm">
                            <td>{{$row->id}}</td>
                            <td>{{$row->id_packaging}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->product_name}}</td>
                            <td>{{$row->image}}</td>
                            <td>{{$row->description}}</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit </a>
                                <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
