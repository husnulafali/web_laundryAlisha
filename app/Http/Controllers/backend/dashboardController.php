<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index(){
        $totalCustomerData = Customer::count();
        $now = Carbon::now();
        $totalOrderToday = Order::whereDate('order_date', $now)->count();
        $totalOrderMonth = Order::whereMonth('order_date', $now->month)->whereYear('order_date', $now->year)->count();
        $totalEarningsToday = $this->getTodayEarnings();
        $totalEarningsMonth = $this->getMonthlyEarnings();
        $pendingEarnings = $this->getPendingEarnings();
        $monthlyEarnings = [];
        if (Auth::User()->hasRole('owner')) {
            $monthlyEarnings = $this->getMonthlyEarningsData();
        }

        return view('admin.dashboard.index', compact('totalCustomerData', 'totalOrderToday', 'totalOrderMonth', 'totalEarningsToday', 'totalEarningsMonth', 'pendingEarnings', 'monthlyEarnings'));
    }

    private function getTodayEarnings(){
        $today = Carbon::today();
        $totalEarnings = DB::table('orders')
            ->whereDate('payment_date', $today)
            ->where('payment_status', 'Lunas')
            ->sum('total_payment');

        return $totalEarnings;
    }

    private function getMonthlyEarnings(){
        $now = Carbon::now();
        $totalEarnings = DB::table('orders')
            ->whereMonth('payment_date', $now->month)
            ->whereYear('payment_date', $now->year)
            ->where('payment_status', 'Lunas')
            ->sum('total_payment');

        return $totalEarnings;
    }

    private function getPendingEarnings(){
        $pendingEarnings = DB::table('orders')
            ->where('payment_status', 'Belum Lunas')
            ->sum('total_payment');

        return $pendingEarnings;
    }

    private function getMonthlyEarningsData(){
        $earnings = DB::table('orders')
            ->select(DB::raw('MONTH(payment_date) as month'), DB::raw('SUM(total_payment) as total'))
            ->where('payment_status', 'Lunas')
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->pluck('total', 'month')
            ->all();

        $monthlyEarnings = array_fill(1, 12, 0);

        foreach ($earnings as $month => $total) {
            $monthlyEarnings[$month] = $total;
        }

        return $monthlyEarnings;
    }
}
