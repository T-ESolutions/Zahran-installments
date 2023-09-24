<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\InvoiceInstallmentsDataTable;
use App\Http\Requests\Dashboard\InvoiceCreateRequest;
use App\DataTables\Dashboard\InvoiceDataTable;
use App\Models\Customer;
use App\Models\InvoiceInstallments;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
 use App\Http\Controllers\GeneralController;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


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
            $data['transaction_number'] = $request->pay_day . '.' .$request->customer_id;

            $invoice = $this->model::create($data);

            if ($request->guarantors_id) {
                $invoice->guarantors()->attach($request->guarantors_id);
            }
            $this->createInstallments($invoice, $data);
            DB::commit();
             Session::flash('success',  trans('lang.created'));
             return response()->json([], 200);
        } catch (\Exception $e) {

            info($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

    private function createInstallments($invoice, $data)
    {
        $months_count = $data['months_count'];
        $pay_day = $data['pay_day'];
        $monthly_installment = $data['monthly_installment'];

        for ($i = 0; $i < $months_count; ++$i) {
            $pay_date = Carbon::now()->addMonth($i + 1)->day($pay_day);

            $invoice->installments()->create([
                'pay_date' => $pay_date,
                'monthly_installment' => $monthly_installment,
            ]);
        }

    }

    public function getInvoice(Request $request)
    {
        $customerId = $request->customer_id;
        $invoices = Invoice::where('customer_id', $customerId)->get(['id','invoice_number']);
        return response()->json($invoices);
    }

    public function indexInstallments(Request $request ,InvoiceInstallmentsDataTable $dataTable,$id)
    {
        return $dataTable->with(['id'=>$id])->render('Dashboard.Invoice.indexInstallments');
    }

    public function changeInstallmentDate(Request $request)
    {


        $request->validate([
            'id' => 'required|exists:invoice_installments,id',
            'pay_date' => ['required','date','after_or_equal:today'],
        ]);

        $installment = InvoiceInstallments::find($request->id);

        $installment->pay_date = $request->pay_date;
        $installment->save();
        return response()->json([], 200);
    }

}
