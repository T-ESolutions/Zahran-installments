<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\InstallmentRequest;


class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['customers'] = Customer::count();
        $data['installment_requests'] = InstallmentRequest::count();
        return view('Dashboard.home', compact('data'));
    }
}
