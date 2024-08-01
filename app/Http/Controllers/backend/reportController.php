<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use PDF;

class reportController extends Controller {

        public function index(){
        return view('admin.report.index');
       }
       public function show(Request $request)
       {
           $request->validate([
               'start_date' => 'required|date',
               'end_date' => 'required|date',
           ], $messages = [
               'start_date.required' => 'Tanggal harus diisi',
               'end_date.required' => 'Tanggal harus diisi'
           ]);
       
           $start_date = \Carbon\Carbon::parse($request->input('start_date'))->startOfDay()->format('Y-m-d H:i:s');
           $end_date = \Carbon\Carbon::parse($request->input('end_date'))->endOfDay()->format('Y-m-d H:i:s');
       
           $report = Order::whereBetween('order_date', [$start_date, $end_date])
                       ->orderBy('order_date', 'asc') //  'asc' untuk naik, 'desc' untuk turun
                       ->get();
       
           return view('admin.report.show', compact('report', 'start_date', 'end_date'));
       }
       
    
    
}
