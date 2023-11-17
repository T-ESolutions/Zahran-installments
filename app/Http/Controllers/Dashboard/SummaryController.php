<?php

namespace App\Http\Controllers\Dashboard;


use App\DataTables\Dashboard\SummaryDataTable;
use App\Exports\CustomersLateListExport;
use App\Http\Controllers\GeneralController;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;

class SummaryController extends GeneralController
{
    protected $viewPath = 'summary';
    protected $path = 'summary';
    private $route = 'summary';

    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function exportLateList(){
        return Excel::download(new CustomersLateListExport(), 'العملاء المتأخرين.xlsx');
    }

    public function index(SummaryDataTable $dataTable)
    {
        return $dataTable->render('Dashboard.summary.index');
    }

}
