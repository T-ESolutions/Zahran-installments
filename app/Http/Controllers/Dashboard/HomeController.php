<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DailyHistory;
use App\Models\InstallmentRequest;
use App\Models\Invoice;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['customers'] = Customer::where('is_blocked',0)->count();
        $data['customers_blocked'] = Customer::where('is_blocked',1)->count();
        $data['invoices'] = Invoice::count();
        $data['installment_requests'] = InstallmentRequest::count();

        $daily_history = DailyHistory::whereDate('created_at', Carbon::now())->orderBy('created_at','desc')->get();
        return view('Dashboard.home', compact('data', 'daily_history'));
    }
}
