@extends('layouts.master')
@section('layouts')


<div class="container-fluid">
<h3 class="h3 mb-3 text-gray-800">Table Paket</h3>
<p class="mb-4">DataTables Paket Alisha Laundry</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('packet.add')}}"><button style="width: 90px; height: 38px; font-size: 16px; border-radius: 4px; float: right; padding: 2px 2px; " type="button" class="btn btn-primary waves-light btn-sm waves-effect">Tambah</button></a>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>          
                        <th class="text-center">No</th>
                        <th class="text-center">Kd_Paket</th>
                        <th class="text-center">Nama Paket</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Waktu Pengerjaan</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($packets as $data)
                    <tr>
                    <td class="text-center">{{ $packets->count() - $loop->index }}</td>
                        <td class="text-center">{{ $data->cd_packets }}</td>
                        <td class="text-center">{{$data->packet_name}}</td>
                        <td class="text-center">
                        @if($data->description)
                        {{$data->description}}
                        @else
                        <span style="color: red;">-</span>
                        @endif
                        </td>
                        <td class="text-center">{{$data->processing_time}}</td>
                        <td class="text-center"> Rp {{ number_format($data->price, 2, ',', '.') }}</td> 
                        <td class="text-center">
                        <a href="{{ route('packet.edit', $data->cd_packets) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-lg" style="color:white"></i></a>
                        <a href="{{ route('packet.delete', $data->cd_packets) }}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg" style="color:white"></i></a>
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
