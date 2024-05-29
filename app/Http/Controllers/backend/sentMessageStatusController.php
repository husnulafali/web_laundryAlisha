<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class sentMessageStatusController extends Controller
{
    public function getMessageStatus($id)
    {
        $deviceToken = Session::get('deviceToken');
        if (!$deviceToken) {
            return view('layouts.topbar')->with('message_status', 'Device token tidak ditemukan dalam sesi.');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $deviceToken
        ])->post('https://api.fonnte.com/status', [
            'id' => $id
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['message_status'])) {
                $messageStatus = $data['message_status'];
            } else {
                $messageStatus = 'Status tidak tersedia';
            }
            return view('layouts.topbar')->with('message_status', $messageStatus);
        } else {
            return view('layouts.topbar')->with('message_status', 'Gagal mengambil status pesan.');
        }
    }

}

