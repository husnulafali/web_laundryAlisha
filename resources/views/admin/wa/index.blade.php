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
                @if (empty($decodedDevicesResponse['data']))
                    <div class="alert alert-danger">
                        No devices available.
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
            <h6 class="m-0 font-weight-bold text-primary">QR CODES </h6>
        </div>
        <div class="card-body">
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
<div style="text-align: center;"> 
    @foreach ($decodedDevicesResponse['data'] as $device)
        @if (!empty($device['show_disconnect']))
            <form action="{{ $device['disconnect_url'] }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">{{ $device['name'] }} Disconnect</button>
            </form>
        @endif
    @endforeach
</div>


        </div>
    </div>
</div>




    </div>
</div>
@endsection
<!-- <script>
    function refreshQRCode() {
        var qrCodeImg = document.getElementById('qrCodeImage');
        fetch('URL_GET_QR_CODE') 
            .then(response => response.text())
            .then(qrCodeUrl => {
                qrCodeImg.src = qrCodeUrl;
            })
            .catch(error => {
                console.error('Error fetching QR code:', error);
            });
    }
    setInterval(refreshQRCode, 5000); 
</script> -->
