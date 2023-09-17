<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\InvoiceInstallmentsDataTable;
use App\Http\Requests\Dashboard\InvoiceCreateRequest;
use App\DataTables\Dashboard\InvoiceDataTable;
use App\Models\Customer;
use App\Models\InvoiceInstallments;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\GeneralController;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;


class InvoiceController extends GeneralController
{

    protected $viewPath = 'Invoice';
    protected $path = 'invoice';
    private $route = 'invoices.index';

    public function __construct(Invoice $model)
    {
        parent::__construct($model);
        $this->middleware('permission:read-invoice', ['only' => ['index','indexInstallments']]);
        $this->middleware('permission:create-invoice', ['only' => ['create', 'store']]);
    }

    public function index(InvoiceDataTable $dataTable)
    {

        return $dataTable->render('Dashboard.Invoice.index');
    }
    public function indexInstallments(Request $request ,InvoiceInstallmentsDataTable $dataTable,$id)
    {
        return $dataTable->with(['id'=>$id])->render('Dashboard.Invoice.indexInstallments');
    }

    public function create()
    {
        $monthly_profit_percent = settings('monthly_profit_percent');
        $customers = Customer::WhiteList()->get(['id', 'name']);
        return view('Dashboard.Invoice.create', compact('monthly_profit_percent', 'customers'));
    }

    public function store(InvoiceCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['admin_id'] = auth()->user()->id;
            $invoice = $this->model::create($data);

            if ($request->guarantors_id) {
                $invoice->guarantors()->attach($request->guarantors_id);
            }

            $months_count = $data['months_count'];
            $pay_day = $data['pay_day'];
            $monthly_installment = $data['monthly_installment'];

            for ($i = 0; $i < $months_count; ++$i) {
                $data = Carbon::now()->addMonth($i+1)->day($pay_day)->format('Y-m-d');
                InvoiceInstallments::create([
                    'invoice_id' => $invoice->id,
                    'pay_date' => $data,
                    'monthly_installment' => $monthly_installment,
                ]);
            }

            DB::commit();
            return redirect()->route($this->route)->with('success', trans('lang.created'));
        } catch (\Exception $e) {
            info($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

}
