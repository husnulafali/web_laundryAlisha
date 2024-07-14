<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:pegawai')->except(['index']);
    }

    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();
        return view('admin.customer.index', compact('customers'));
    }

    public function add()
    {
        $newKodeCustomer = 'KP' . substr(Str::uuid()->toString(), 0, 5);
        return view('admin.customer.add', compact('newKodeCustomer'));
    }
    public function store(Request $request)
{
    $rules = [
        'cd_customers' => 'required', 
        'customer_name' => 'required',
        'address' => 'required',
        'phone_number' => 'required|unique:customers|digits_between:10,12' 
    ];
    
    $messages = [
        'cd_customers.required' => '*Kode Pelanggan harus diisi',
        'customer_name.required' => '*Nama harus diisi',
        'address.required' => '*Deskripsi harus diisi',
        'phone_number.required' => '*Nomor Telphone harus diisi',
        'phone_number.unique' => '*Nomor Telphone sudah digunakan',
        'phone_number.digits_between' => '*Nomor Telphone harus terdiri dari 10 hingga 12 digit Angka',
    ];

    $this->validate($request, $rules, $messages);

    $customer = new Customer();
    $customer->cd_customers = $request->input('cd_customers'); 
    $customer->customer_name = $request->input('customer_name');
    $customer->address = $request->input('address');
    $customer->phone_number = $request->input('phone_number');

    $customer->save();
    return redirect()->route('customer.index')->with('success', 'Pelanggan berhasil ditambahkan');
}

    public function edit(Request $request, $cd_customers){

    $editData = Customer::findOrFail($cd_customers);
     return view('admin.customer.edit', compact('editData'));

}

public function update(Request $request, $cd_customers){
    $rules = [
        'customer_name' => 'required',
        'address' => 'required',
        'phone_number' => 'required|digits_between:10,12|unique:customers,phone_number,'.$cd_customers.',cd_customers'
    ];

    $messages = [
        'customer_name.required' => '*Nama harus diisi',
        'address.required' => '*Alamat harus diisi',
        'phone_number.required' => '*Nomor Telepon harus diisi',
        'phone_number.digits_between' => '*Nomor Telepon harus terdiri dari 10 hingga 12 digit',
        'phone_number.unique' => '*Nomor Telepon sudah digunakan'
    ];

    $this->validate($request, $rules, $messages);
    $customer = Customer::findOrFail($cd_customers);
    $customer->customer_name = $request->input('customer_name');
    $customer->address = $request->input('address');
    $customer->phone_number = $request->input('phone_number');
    $customer->save();
    return redirect()->route('customer.index')->with('success', 'Data pelanggan berhasil diperbarui');
}

    public function delete($cd_customers){
    $customer=Customer::find($cd_customers);
    $customer->delete();
   return  redirect()->route('customer.index')->with('success', 'data berhasil di hapus');

}

}
