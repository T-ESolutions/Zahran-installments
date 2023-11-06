<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\LateInstallmentsExport;
use App\Exports\MonthInstallmentsExport;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DailyHistory;
use App\Models\InstallmentRequest;
use App\Models\Invoice;
use App\Models\InvoiceInstallments;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

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
        $late_installments = InvoiceInstallments::where('status',3)->orderBy('pay_date','asc')->get();
        $today_installments = InvoiceInstallments::where('pay_date',Carbon::now()->format('Y-m-d'))->orderBy('created_at','asc')->get();
        $month_installments = InvoiceInstallments::whereMonth('pay_date',Carbon::now()->month)->orderBy('pay_date','asc')->get();
        return view('Dashboard.home', compact('data', 'daily_history','late_installments','today_installments','month_installments'));
    }

    public function exportMonthInstallments(){
        return Excel::download(new MonthInstallmentsExport(), 'اقساط الشهر الحالي.xlsx');
    }

    public function exportLateInstallments(){
        return Excel::download(new LateInstallmentsExport(), 'الاقساط المتأخره.xlsx');
    }

}
