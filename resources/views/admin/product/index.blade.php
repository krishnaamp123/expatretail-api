@extends('admin.layout.app')
@section('title', 'Product')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product</h1>

    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <p class="mb-3">Master data product item retail</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('addProduct')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add </a>
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
                            <td class="text-center">
                                @if ($row->image)
                                    <img src="{{ asset('storage/image/' . $row->image) }}" alt="Product Image" width="100" height="100">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{$row->description}}</td>

                                <td>
                                    <a href="{{ route('editProduct', $row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('destroyProduct', $row->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
