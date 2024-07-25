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
    <h3 class="h3 mb-3 text-gray-800">Table Pelanggan</h3>
    <p class="mb-4">DataTables Pelanggan Alisha Laundry</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if (Auth::user()->role == 'pegawai')
                <a href="{{ route('customer.add') }}">
                    <button style="width: 90px; height: 38px; font-size: 16px; border-radius: 4px; float: right; padding: 2px 2px;" type="button" class="btn btn-primary waves-light btn-sm waves-effect">Tambah</button>
                </a>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Pelanggan</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">NoTelp</th>
                            @if (Auth::user()->role == 'pegawai')
                                <th class="text-center">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $data)
                            <tr>
                                <td class="text-center">{{ $customers->count() - $loop->index }}</td>
                                <td class="text-center">{{ $data->cd_customers }}</td>
                                <td class="text-center">{{ $data->customer_name }}</td>
                                <td class="text-center">{{ $data->address }}</td>
                                <td class="text-center">{{ $data->phone_number }}</td>
                                @if (Auth::user()->role == 'pegawai')
                                    <td class="text-center">
                                        <a href="{{ route('customer.edit', $data->cd_customers) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit fa-lg" style="color:white"></i>
                                        </a>
                                        <a href="{{ route('customer.delete', $data->cd_customers) }}" id="delete" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash fa-lg" style="color:white"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
