<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packet;
use Illuminate\Support\Str;

class packetController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:owner')->except(['index']);
    }
    public function index(){
        $packets = Packet::orderBy('created_at', 'desc')->get();
        return view('admin.packet.index', compact('packets'));
    }
    public function add()
    {
        $newKodePacket = 'KPA' . substr(Str::uuid()->toString(), 0, 5);
        return view('admin.packet.add', compact('newKodePacket'));
    }
    public function store(Request $request)
{
    $rules = [
        'cd_packets' => 'required', 
        'packet_name' => 'required',
        'description' => 'nullable|string',
        'processing_time' => 'required',
        'price' => 'required|numeric',
    ];
    
    $messages = [
        'packet_name.required' => 'Nama paket harus diisi',
        'processing_time.required' => 'Waktu pengerjaan harus diisi',
        'price.required' => 'Harga harus diisi',
        'price.numeric' => 'Harga harus berupa angka',
    ];

    $this->validate($request, $rules, $messages);


    $packet = new Packet();
    $packet->cd_packets = $request->input('cd_packets'); 
    $packet->packet_name = $request->input('packet_name');
    $packet->description = $request->input('description');
    $packet->processing_time =$request->input('processing_time');
    $packet->price = $request->input('price');

    $packet->save();
    return redirect()->route('packet.index')->with('success', 'Paket berhasil ditambahkan');
}
    public function edit(Request $request, $cd_packets){

    $editData = Packet::findOrFail($cd_packets);
     return view('admin.packet.edit', compact('editData'));
}
    public function update(Request $request, $cd_packets){
        $rules = [
            'packet_name' => 'required',
            'description' => 'nullable|string',
            'processing_time' => 'required',
            'price' => 'required|numeric',
        ];
        
        $messages = [
            'packet_name.required' => 'Nama paket harus diisi',
            'processing_time.required' => 'Waktu pengerjaan harus diisi',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
        ];
    
        $this->validate($request, $rules, $messages);
        $packet = Packet::findOrFail($cd_packets);
        $packet->packet_name = $request->input('packet_name');
        $packet->description = $request->input('description');
        $packet->processing_time =$request->input('processing_time');
        $packet->price = $request->input('price');
    
        $packet->save();
        return redirect()->route('packet.index')->with('success', 'Paket berhasil diperbaruhi');
    }
    public function delete($cd_packets){
        $packet=Packet::find($cd_packets);
        $packet->delete();
       return  redirect()->route('packet.index')->with('success', 'data berhasil di hapus');
    
    }
    
}
