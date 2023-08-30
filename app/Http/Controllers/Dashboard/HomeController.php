<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;


class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['customers'] = Customer::count();
        return view('Dashboard.home', compact('data'));
    }
}
