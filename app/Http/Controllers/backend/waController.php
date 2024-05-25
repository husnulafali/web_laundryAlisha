<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class waController extends Controller
{
    public function getDevices()
    {
        $authToken = env('FONNTE_AUTH_TOKEN');
        $devicesResponse = Http::withHeaders([
            'Authorization' => $authToken,
        ])->post('https://api.fonnte.com/get-devices');
    
        $decodedDevicesResponse = $devicesResponse->json();
        $error = null;
        $qr = null;
        $deviceName = null;
        $success = null;
    
        if (!$devicesResponse->successful()) {
            $error = "Failed to get devices: " . $devicesResponse->status();
        } elseif (!isset($decodedDevicesResponse['data']) || !isset($decodedDevicesResponse['data'][0]['token'])) {
            $error = "Device token tidak ditemukan";
        } else {
            $deviceToken = $decodedDevicesResponse['data'][0]['token'];
            $deviceName = $decodedDevicesResponse['data'][0]['device'];
    
            $qrResponse = Http::withHeaders([
                'Authorization' => $deviceToken,
            ])->post('https://api.fonnte.com/qr');
    
            if (!$qrResponse->successful()) {
                $error = "Failed to get QR code: " . $qrResponse->status();
            } else {
                $decodedQrResponse = $qrResponse->json();
                $qr = $decodedQrResponse['url'] ?? ($decodedQrResponse['code'] ?? $decodedQrResponse['reason'] ?? null);
                $success = "QR code berhasil dipindai!";
            }
        }
    
        return view('admin.wa.index', compact('decodedDevicesResponse', 'qr', 'deviceName', 'error', 'success'));
    }
    
}
       
    

  

    
    

