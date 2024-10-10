@extends('admin.layout.app')
@section('title', 'User')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>

    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <p class="mb-3">Master data user retail app</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('addUser')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="fa-sm text-center">
                            <th>ID</th>
                            <th>ID_Group</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Customer Name</th>
                            <th>PIC Name</th>
                            <th>PIC Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $row)
                        <tr class="fa-sm">
                            <td>{{$row->id}}</td>
                            <td>{{$row->id_group}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->password}}</td>
                            <td>{{$row->customer_name}}</td>
                            <td>{{$row->pic_name}}</td>
                            <td>{{$row->pic_phone}}</td>
                            <td>{{$row->address}}</td>
                            <td>{{$row->role}}</td>
                                <td>
                                    <a href="{{ route('editUser', $row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('destroyUser', $row->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash"></i> Delete</button>
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
