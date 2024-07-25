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

    
<h3 class="h3 mb-3 text-gray-800">Table Orders</h3>
<p class="mb-4">DataTables Orders Alisha Laundry</p>

<div class="card shadow mb-4">
<div class="card-header py-3">
    @if (Auth::user()->role == 'pegawai')

    <a href="{{ route('order.updateMessage')}}">
            <button style="width: 120px; height: 38px; font-size: 16px; border-radius: 4px; float: right; padding: 2px 2px; margin-left: 10px;" type="button" class="btn btn-warning waves-light btn-sm waves-effect">Custom Pesan</button>
        </a>
        <a href="{{ route('order.add') }}">
            <button style="width: 90px; height: 38px; font-size: 16px; border-radius: 4px; float: right; padding: 2px 2px; " type="button" class="btn btn-primary waves-light btn-sm waves-effect">Tambah</button>
        </a>
        
    @endif
</div>

      
  
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>          
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal Order</th>
                        <th class="text-center">kode order</th>
                        <th class="text-center">Nama Customer</th>
                        <th class="text-center">Jenis Paket</th>
                        <th class="text-center">Berat</th>
                        <th class="text-center">Diskon</th>
                        <th class="text-center">Total Bayar</th>
                        <th class="text-center">Status Pembayaran</th>
                        <th class="text-center">Tanggal Pembayaran</th>
                        <th class="text-center">Status Laundry</th>
                        <th class="text-center">Catatan</th>
                        @if (Auth::user()->role == 'pegawai')
                                <th class="text-center">Action</th>
                            @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $data)
                    <tr>
                        <td class="text-center">{{ $orders->count() - $loop->index }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->order_date)->format('d/m/Y H:i') }}</td>
                        <td class="text-center">{{$data->cd_orders}}</td>
                        <td class="text-center">{{ optional($data->customers)->customer_name ?? '-' }}</td>
                        <td class="text-center">{{ optional($data->packets)->packet_name ?? '-' }}</td>
                        <td class="text-center">{{$data->weight}} /kg</td>
                        <td class="text-center">{{ $data->discount ?? '-' }}%</td>
                        <td class="text-center">Rp.{{ number_format($data->total_payment, 2, ',', '.') }}</td>    
                        <td class="text-center" style="color: {{ $data->payment_status === 'Belum Lunas' ? 'red' : 'green' }}">{{ $data->payment_status }}</td>
                        <td class="text-center">{{ isset($data->payment_date) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->payment_date)->format('d/m/Y H:i') : '-' }}</td>
                        <td class="text-center">
                                    @if (Auth::user()->role == 'pegawai')
                                        <form action="{{ route('order.updateLaundryStatus', $data->cd_orders) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <select name="status" onchange="this.form.submit()">
                                                <option value="Baru" {{ $data->laundry_status == 'Baru' ? 'selected' : '' }}>Baru</option>
                                                <option value="Pengerjaan" {{ $data->laundry_status == 'Pengerjaan' ? 'selected' : '' }}>Pengerjaan</option>
                                                <option value="Selesai" {{ $data->laundry_status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="di Antar" {{ $data->laundry_status == 'di Antar' ? 'selected' : '' }}>di Antar</option>
                                            </select>
                                        </form>
                                    @else
                                        {{ $data->laundry_status }}
                                    @endif
                                </td>
                        <td class="text-center">{{ $data->note ?? '-' }}</td>  
                        @if (Auth::user()->role == 'pegawai')
                        <td class="text-center" style="display: flex; justify-content: center; gap: 5px;">
                        <a href="{{ route('order.edit', $data->cd_orders) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit fa-lg" style="color:white"></i>
                        </a>

                        <a href="{{ route('order.print', $data->cd_orders) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-print fa-lg" style="color:white"></i>
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





