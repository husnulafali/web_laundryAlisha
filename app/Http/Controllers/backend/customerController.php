<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function index (){
        return view('admin.customer.index');
    }
    public function add()
    {
        $lastCustomer = Customer::latest('cd_customer')->first();
        if ($lastCustomer) {
            $lastNumber = (int) substr($lastCustomer->cd_customer, 5);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $newKodePelanggan = 'KC' . str_pad($newNumber, 5, '00001', STR_PAD_LEFT);
        return view('admin.customer.add');
    }
}
