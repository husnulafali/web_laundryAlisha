<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Packet;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{

   public function __construct()
    {
        if (!Session::has('deviceToken')) {
            app(waController::class)->getDevices();
        }
        $this->middleware('role:pegawai')->except(['index']);
    }

    public function index(){
        $order['orders'] = Order::with(['customers', 'packets'])->orderBy('created_at', 'desc')->get();
            return view('admin.order.index', $order);
    }
    public function add()
    {
        $newKodeOrder = 'AL' . substr(Str::uuid()->toString(), 0, 7);
        $customers=Customer::all();
        $packets=Packet::all();
        return view('admin.order.add', compact('newKodeOrder','customers','packets'));
    }
    public function store(Request $request)
{
    $rules = [
        'cd_orders' => 'required',
        'cd_customers' => 'required',
        'cd_packets' => 'required',
        'order_date' => 'required|date_format:d/m/Y H:i', 
        'weight' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'total_payment' => 'required',
        'payment_date' => 'nullable|date_format:d/m/Y H:i', 
        'payment_status' => 'required|in:Belum Lunas,Lunas',
        'laundry_status' => 'nullable|in:Baru,Pengerjaan,Selesai,di Antar',
        'note' => 'nullable'
    ];

    $messages = [
        'cd_orders.required' => 'Kode order wajib diisi.',
        'cd_customers.required' => 'Kode pelanggan wajib diisi.',
        'cd_packets.required' => 'Kode paket wajib diisi.',
        'order_date.required' => 'Tanggal order wajib diisi.',
        'order_date.date_format' => 'Format tanggal dan waktu harus dd/mm/yyyy HH:ii.',
        'weight.required' => 'Berat laundry wajib diisi.',
        'weight.numeric' => 'Berat laundry harus berupa angka.',
        'discount.numeric' => 'Diskon harus berupa angka.',
        'total_payment.required' => 'Total pembayaran wajib diisi.',
        'payment_status.required' => 'Status pembayaran wajib diisi.',
        'payment_status.in' => 'Status pembayaran harus "Belum Lunas" atau "Lunas".',
        'laundry_status.in' => 'Status laundry tidak valid.',
    ];

    $this->validate($request, $rules, $messages);

    
    $orderDate = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $request->order_date)->format('Y-m-d H:i:s');
    $paymentDate = $request->filled('payment_date') ? \Carbon\Carbon::createFromFormat('d/m/Y H:i', $request->payment_date)->format('Y-m-d H:i:s') : null;

    $order = new Order();
    $order->cd_orders = $request->input('cd_orders');
    $order->cd_customers = $request->input('cd_customers');
    $order->cd_packets = $request->input('cd_packets');
    $order->order_date = $orderDate;
    $order->weight = $request->weight;
    $order->discount = $request->discount;
    $order->total_payment = $request->total_payment;
    $order->payment_date = $paymentDate;
    $order->payment_status = $request->payment_status;
    $order->laundry_status = $request->input('laundry_status', 'Baru');
    $order->note = $request->note;
   

    $packet = Packet::find($request->cd_packets);
    if ($packet) {
        $totalPayment = $packet->price * $request->weight;

        if ($request->discount) {
            $Discount = $request->discount;
            $totalDiscount = ($Discount / 100) * $totalPayment;
            $totalPayment -= $totalDiscount;
        }

        $order->total_payment = max(0, $totalPayment);
    }

    $order->save();

 

    return redirect()->route('order.index')->with('success', 'Order berhasil ditambahkan');
}


        public function edit($cd_orders)
        {
            $editData = Order::findOrFail($cd_orders);
            $customers = Customer::all();
            $packets = Packet::all();
            return view('admin.order.edit', compact('editData', 'customers', 'packets'));
        }
    
        public function update(Request $request, $cd_orders)
        {
            $rules = [
                'cd_orders' => 'required',
                'cd_customers' => 'required',
                'cd_packets' => 'required',
                'order_date' => 'required|date_format:d/m/Y H:i',
                'weight' => 'required|numeric',
                'discount' => 'nullable|numeric',
                'total_payment' => 'required',
                'payment_date' =>'nullable|date_format:d/m/Y H:i', 
                'payment_status' => 'required|in:Belum Lunas,Lunas',
                'laundry_status' => 'nullable|in:Baru,Pengerjaan,Selesai,di Antar',
                'note' => 'nullable'
            ];
    
            $messages = [
                'cd_orders.required' => 'Kode order wajib diisi.',
                'cd_customers.required' => 'Kode pelanggan wajib diisi.',
                'cd_packets.required' => 'Kode paket wajib diisi.',
                'order_date.required' => 'Tanggal order wajib diisi.',
                'weight.required' => 'Berat laundry wajib diisi.',
                'weight.numeric' => 'Berat laundry harus berupa angka.',
                'discount.numeric' => 'Diskon harus berupa angka.',
                'total_payment.required' => 'Total pembayaran wajib diisi.',
                'payment_status.required' => 'Status pembayaran wajib diisi.',
                'payment_status.in' => 'Status pembayaran harus "Belum Lunas" atau "Lunas".',
                'laundry_status.in' => 'Status laundry tidak valid.',
            ];
    
            $this->validate($request, $rules, $messages);
    
            $orderDate = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $request->order_date)->format('Y-m-d H:i:s ');
            $paymentDate = $request->filled('payment_date') ? \Carbon\Carbon::createFromFormat('d/m/Y H:i', $request->payment_date)->format('Y-m-d H:i:s') : null;
    
            $order = Order::findOrFail($cd_orders);
            $order->cd_orders = $request->input('cd_orders'); 
            $order->cd_customers = $request->input('cd_customers'); 
            $order->cd_packets = $request->input('cd_packets'); 
            $order->order_date = $orderDate;
            $order->weight = $request->weight;
            $order->discount = $request->discount;
            $order->total_payment = $request->total_payment;
            $order->payment_date = $paymentDate;
            $order->payment_status = $request->payment_status;
           
            $order->note = $request->note;

            if ($request->has('laundry_status')) {
                $order->laundry_status = $request->input('laundry_status');
            }
    
            $packet = Packet::find($request->cd_packets);
            if ($packet) {
                $totalPayment = $packet->price * $request->weight;
    
                if ($request->discount) {
                    $Discount = $request->discount;
                    $totalDiscount = ($Discount / 100) * $totalPayment;
                    $totalPayment -= $totalDiscount;
                }
                $order->total_payment = max(0, $totalPayment);
            }
    
            $order->save();
    
            return redirect()->route('order.index')->with('success', 'Order berhasil diperbarui');
        }

        public function print($cdOrders)
        {
            $order = Order::where('cd_orders', $cdOrders)->first();
            $userId = session('user_id'); 
        
            if (!$order) {
                return abort(404);
            }
        
            $user = User::find($userId);
            return view('admin.order.print', compact('order', 'user'));
        }

        public function handleMessageStatusUpdate(Request $request){
            $messageId = $request->input('id');
            $status = $request->input('message_status');
    
            $order = Order::where('message_id', $messageId)->first();
            if ($order) {
            $order->message_status = $status;
            $order->save();
        }
        return response()->json(['status' => 'success']);
    }
    
             public function editMessage(){
        return view('admin.order.editMessage');
    }
    
    public function updateMessage(Request $request)
    {
        $request->validate([
            'custom_message' => 'nullable|string',
        ]);
    
        $userId = Auth::id();
    
        cache()->put("user_{$userId}_custom_message", $request->custom_message);
        session()->put('custom_message', $request->custom_message);
    
        return redirect()->route('order.index')->with('success', 'Pesan berhasil diperbarui');
    }
    
    
       public function updateLaundryStatus(Request $request, $cd_orders){
        $order = Order::findOrFail($cd_orders);
    
        $request->validate([
            'status' => 'required|in:Baru,Pengerjaan,Selesai,di Antar',
        ]);
    
        $order->laundry_status = $request->status;
        $order->save();
    
        if ($order->laundry_status === 'Selesai') {
            $customer = $order->customers;
            $phoneNumber = $customer->phone_number;
            $customerName = $customer->customer_name;
            $defaultMessage = "Halo *{customerName}*,\nLaundry Anda dengan kode order *{orderCode}* telah *{status}*.\n";
            $customMessage = cache()->get("user_" . Auth::id() . "_custom_message");
            $message = str_replace(['{customerName}', '{orderCode}', '{status}'], [$customerName, $order->cd_orders, $order->laundry_status], $customMessage ?: $defaultMessage);
    
            $deviceToken = session('deviceToken');
            if ($deviceToken) {
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => [
                        'target' => $phoneNumber,
                        'message' => $message
                    ],
                    CURLOPT_HTTPHEADER => [
                        'Authorization: ' . $deviceToken
                    ],
                ]);
                $response = curl_exec($curl);
                $responseData = json_decode($response, true);
                curl_close($curl);
    
                if (isset($responseData['id'])) {
                    $messageId = $responseData['id'];  
                    $order->message_id = $messageId;
                    $order->save();
    
                    return back()->with('success', 'Pesan berhasil dikirim ');
                } else {
                    return back()->with('error', 'Gagal mengirim pesan coba periksa tautan Wa');
                }
                } else {
                return back()->with('error', 'Gagal mengirim pesan, device tidak ditemukan');
            
            }
        }
    
        return back()->with('success', 'Status laundry berhasil diperbarui');
       }
    }
       
     