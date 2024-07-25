@extends('layouts.master')
@section('layouts')


<div class="container-fluid">
    
     <!-- Alert Messages -->
 @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

<h3 class="h3 mb-3 text-gray-800">Table Data Pengguna</h3>
<p class="mb-4">Data Pengguna Alisha Laundry</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('user.add')}}"><button style="width: 90px; height: 38px; font-size: 16px; border-radius: 4px; float: right; padding: 2px 2px; " type="button" class="btn btn-primary waves-light btn-sm waves-effect">Tambah</button></a>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>          
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $data)
                    <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $data->name }}</td>
                        <td class="text-center">{{ $data->username }}</td>
                        <td class="text-center">{{$data->email}}</td>
                        <td class="text-center">{{$data->role}}</td>
                        <td class="text-center">
                        <a href="{{ route('user.edit', $data->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-lg" style="color:white"></i></a>
                        <a href="{{ route('user.delete', $data->id) }}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg" style="color:white"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
@endsection
