@extends('layouts.master')
@section('layouts')


<div class="container-fluid">
<h3 class="h3 mb-3 text-gray-800">Table Orders</h3>
<p class="mb-4">DataTables Orders Alisha Laundry</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('order.add')}}"><button style="width: 90px; height: 38px; font-size: 16px; border-radius: 4px; float: right; padding: 2px 2px; " type="button" class="btn btn-primary waves-light btn-sm waves-effect">Tambah</button></a>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $data)
                    <tr>
                    <td class="text-center">{{ $orders->count() - $loop->index }}</td>
                    <td class="text-center">  {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->order_date)->format('d/m/Y H:i') }}</td>
                        <td class="text-center">{{$data->cd_orders}}</td>
                        <td class="text-center">{{ optional($data->customers)->customer_name ?? '-' }}</td>
                        <td class="text-center">{{ optional($data->packets)->packet_name ?? '-' }}</td>
                        <td class="text-center">{{$data->weight}} /kg</td>
                        <td class="text-center">{{ $data->discount ?? '-' }}%</td>
                        <td class="text-center">Rp.{{ number_format($data->total_payment, 2) }}</td>    
                        <td class="text-center" style="color: {{ $data->payment_status === 'Belum Lunas' ? 'red' : 'green' }}">{{ $data->payment_status }}</td>
                        <td class="text-center">{{ isset($data->payment_date) ? \Carbon\Carbon::createFromFormat('Y-m-d', $data->payment_date)->format('d/m/Y') : '-' }}</td>
                        <td class="text-center">
                        <form action="{{ route('order.updateLaundryStatus', $data->cd_orders) }}" method="POST">
                         @csrf
                         @method('POST')
                        <select name="status" onchange="this.form.submit()">
                        <option value="Baru" {{ $data->laundry_status == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Dalam Pengerjaan" {{ $data->laundry_status == 'Dalam Pengerjaan' ? 'selected' : '' }}>Dalam Pengerjaan</option>
                        <option value="Laundry Selesai" {{ $data->laundry_status == 'Laundry Selesai' ? 'selected' : '' }}>Laundry Selesai</option>
                        <option value="di Antar" {{ $data->laundry_status == 'di Antar' ? 'selected' : '' }}>di Antar</option>
                         </select>
                        </form>
                        </td>
                        <td class="text-center">{{ $data->note ?? '-' }}</td>  
                        <td>
                        <div style="display: flex; gap: 2px;">
                         <a href="{{ route('order.edit', $data->cd_orders) }}" class="btn btn-warning btn-sm" style="display: inline-block; margin-right: 5px;">
                          <i class="fa fa-edit fa-lg" style="color:white"></i>
                         </a>
                          <a href="" target="_blank" class="btn btn-success btn-sm" style="display: inline-block;">
                         <i class="fa fa-print fa-lg" style="color:white"></i>
                          </a>
                          </div>

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


