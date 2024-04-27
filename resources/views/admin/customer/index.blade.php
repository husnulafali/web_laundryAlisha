@extends('layouts.master')
@section('layouts')


<div class="container-fluid">
<h3 class="h3 mb-3 text-gray-800">Table Pelanggan</h3>
<p class="mb-4">DataTables Customers Alisha Laundry</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('customer.add')}}"><button style="width: 90px; height: 38px; font-size: 16px; border-radius: 4px; float: right; padding: 2px 2px; " type="button" class="btn btn-primary waves-light btn-sm waves-effect">Tambah</button></a>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kd_Pelanggan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>NoTelp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
@endsection
