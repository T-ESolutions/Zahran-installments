<?php

namespace App\Http\Controllers\Dashboard;


use App\Exports\CustomersLateListExport;
use App\DataTables\Dashboard\CustomerDataTable;
use App\Http\Controllers\GeneralController;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;

class SummaryController extends GeneralController
{
    protected $viewPath = 'Customer';
    protected $path = 'customer';
    private $route = 'customers.index';

    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }



    public function exportLateList(){
        return Excel::download(new CustomersLateListExport(), 'العملاء المتأخرين.xlsx');
    }

    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('Dashboard.Customer.index');
    }

}
