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

    <h3 class="h3 mb-3 text-gray-800">Perangkat Tertaut</h3>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DETAIL PERANGKAT</h6>
                </div>
                <div class="card-body">
                    @if (empty($decodedDevicesResponse['data']))
                        <div class="alert alert-danger">
                            Tidak di temukan perangkat
                        </div>
                    @else
                        <ul class="device-list">
                            @foreach ($decodedDevicesResponse['data'] as $device)
                                <li class="device-item">
                                    <span style="margin-right:100px;"><strong>Nama:</strong> {{ $device['name'] }}</span>
                                    <span style="margin-right:100px;"><strong>WA:</strong> {{ $device['device'] }}</span>
                                    <strong>Status:</strong><span style="margin-right: 100px; color: {{ $device['status'] === 'connect' ? 'green' : 'red' }}">{{ $device['status'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">QR CODES</h6>
                </div>
                <div class="card-body">
                    @if (auth()->user()->hasRole('owner'))
                        @if (!empty($qrCodes) && count($qrCodes) > 0)
                            <ul style="text-align: center;"> 
                                @foreach ($qrCodes as $deviceName => $qr)
                                    <li style="display: inline-block; margin-bottom: 20px;">
                                        <div style="font-weight: bold;">*{{ $deviceName }}</div>
                                        <img src="data:image/png;base64,{{ $qr }}" alt="QR Code">
                                    </li>
                                @endforeach
                            </ul>
                       
                        @endif
                    @else
                        <div class="alert alert-info">
                          Akses Owner
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection