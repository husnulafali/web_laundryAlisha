<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class waController extends Controller{
    public function getDevices()
    {
        $authToken = env('FONNTE_AUTH_TOKEN');
        $error = null;
        $success = null;
        $qrCodes = [];
        $deviceName = null;
        $decodedDevicesResponse = [];
        $devicesResponse = Http::withHeaders([
            'Authorization' => $authToken,
        ])->post('https://api.fonnte.com/get-devices');
    
        $decodedDevicesResponse = $devicesResponse->json();
    
        if (!$devicesResponse->successful()) {
            $error = "Failed to get devices: " . $devicesResponse->status();
        } elseif (!isset($decodedDevicesResponse['data']) || empty($decodedDevicesResponse['data'])) {
            $error = "No devices found";
        } else {
            foreach ($decodedDevicesResponse['data'] as &$device) {
                $deviceToken = $device['token'];
                $qr = $this->getQrCode($deviceToken);
    
                if ($qr) {
                    $qrCodes[$device['name']] = $qr;
                    $success = "QR code berhasil dipindai!";
                } else {
                    $error = "Failed to get QR code for one or more devices";
                }
                $device['disconnect_url'] = route('devices.disconnect', ['deviceToken' => $deviceToken]);
                $device['show_disconnect'] = $device['status'] === 'connect';
                Session::put('deviceToken', $deviceToken);
            }
        }
    
        return view('admin.wa.index', compact('decodedDevicesResponse', 'qrCodes', 'deviceName', 'error', 'success'));
    }
    
    public function getQrCode($deviceToken)
    {
        $qrResponse = Http::withHeaders([
            'Authorization' => $deviceToken,
        ])->post('https://api.fonnte.com/qr');

        if ($qrResponse->successful()) {
            $decodedQrResponse = $qrResponse->json();
            return $decodedQrResponse['url'] ?? null;
        }

        return null;
    }

    public function disconnectDevice($deviceToken)
    {
        $response = Http::withHeaders([
            'Authorization' => $deviceToken, 
        ])->post('https://api.fonnte.com/disconnect', [
            'device_token' => $deviceToken,
        ]);

        if ($response->successful()) {
            $message = "Device disconnected successfully.";
        } else {
            $message = "Failed to disconnect device: " . $response->status();
        }

        return redirect()->back()->with('message', $message);
        
    }
    
}
    

  

    
    

