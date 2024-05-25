@extends('layouts.master')

@section('layouts')
<div class="container-fluid">
    <h3 class="h3 mb-3 text-gray-800">Perangkat Tertaut</h3>


        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DETAIL PERANGKAT</h6>
                    </div>
                    <div class="card-body">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        @if (isset($decodedDevicesResponse['data']))
                            <ul class="device-list">
                                @foreach ($decodedDevicesResponse['data'] as $device)
                                    <li class="device-item">
                                        <span><strong>Name:</strong> {{ $device['name'] }}</span>
                                        <span><strong>Device:</strong> {{ $device['device'] }}</span>
                                        <span><strong>Device:</strong> {{ $device['device'] }}</span>
                                        @if ($device['status'] === 'connect')
                                            <span><strong>Status:</strong> <span class="text-success">{{ $device['status'] }}</span></span>
                                        @elseif ($device['status'] === 'disconnect')
                                            <span><strong>Status:</strong> <span class="text-danger">{{ $device['status'] }}</span></span>
                                        @else
                                            <span><strong>Status:</strong> {{ $device['status'] }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No devices found.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">QR CODE</h6>
                    </div>
                    <div class="card-body">
                        @if (isset($qr))
                            <p>Device: {{ $deviceName }}</p>
                            <img src="data:image/png;base64,{{ $qr }}" alt="QR Code">
                        @else
                        <div class="alert alert-danger">
                                QR Code not available.
                            </div>
                        @endif
        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
