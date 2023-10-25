<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\InvoiceInstallmentsDataTable;
use App\Enums\InvoiceInstallmentsStatusEnum;
use App\Http\Requests\Dashboard\InvoiceCreateRequest;
use App\DataTables\Dashboard\InvoiceDataTable;
use App\Models\Customer;
use App\Models\DailyHistory;
use App\Models\InvoiceInstallments;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\GeneralController;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;


class InvoiceController extends GeneralController
{

    protected $viewPath = 'Invoice';
    protected $path = 'invoice';
    private $route = 'invoices.index';

    public function __construct(Invoice $model)
    {
        parent::__construct($model);
        $this->middleware('permission:read-invoice', ['only' => ['index', 'indexInstallments']]);
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

    public function print_insurance_paper(Customer $customer)
    {

        return view('Dashboard.Invoice.print', compact('customer'));
    }

    public function store(InvoiceCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['admin_id'] = auth()->user()->id;
            $data['transaction_number'] = $request->pay_day . '.' . $request->customer_id;

            $invoice = Invoice::create($data);

            if ($request->guarantors_id) {
                $invoice->guarantors()->attach($request->guarantors_id);
            }
            $this->createInstallments($invoice, $data);
            DB::commit();
            Session::flash('success', trans('lang.created'));
//            return response()->json([], 200);
            return response()->json(['status' => true, 'id' => $invoice->id], 200);
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

            $installment = $invoice->installments()->create([
                'pay_date' => $pay_date,
                'monthly_installment' => $monthly_installment,
            ]);

            $installment->history()->create([
                'description' => '  انشاء قسط بمبلغ ' . $monthly_installment . ' وتاريخ الدفع ' . $pay_date . '',
                'invoice_id' => $invoice->id,
                'admin_id' => auth()->user()->id,
            ]);
        }

    }

    public function getInvoice(Request $request)
    {
        $customerId = $request->customer_id;
        $invoices = Invoice::where('customer_id', $customerId)->get(['id', 'invoice_number']);
        return response()->json($invoices);
    }

    public function indexInstallments(Request $request, InvoiceInstallmentsDataTable $dataTable, $id)
    {
        $invoice = Invoice::with('customer', 'guarantors', 'invoice.guarantors', 'unPaidLawSuit')->find($id);
        $installments = $invoice->installments();
        $sum_monthly_installment = $installments->sum('monthly_installment');
        $sum_paid_amount = $installments->sum('paid_amount');
        $sum_remaining_amount = $sum_monthly_installment - $sum_paid_amount;
        return $dataTable->with(['id' => $id])->render('Dashboard.Invoice.indexInstallments', compact('invoice', 'sum_remaining_amount'));
    }

    public function changeInstallmentDate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:invoice_installments,id',
            'pay_date' => ['required', 'date', 'after_or_equal:today'],
        ]);
        $installment = InvoiceInstallments::find($request->id);

        $installment->history()->create([
            'description' => '  تغيير موعد القسط من يوم ' . $installment->pay_date . ' الى يوم ' . $request->pay_date . '',
            'invoice_id' => $installment->invoice_id,
            'admin_id' => auth()->user()->id,
        ]);

        $installment->pay_date = $request->pay_date;
        $installment->save();
        return response()->json([], 200);
    }

    public function postingInstallment(Request $request)
    {
        $installment = InvoiceInstallments::find($request->id);

        if ($installment->status == InvoiceInstallmentsStatusEnum::PAID->value) {
            return response()->json(['status' => false, 'msg' => 'لا يمكن تأجيل قسط مدفوع بالفعل'], 200);
        }

        $available_days = 20;
        $validation_dys = $available_days - $installment->moved_days;
        if ($installment->moved_days == $available_days) {
            throw ValidationException::withMessages([
                'days_count' => 'لا يمكن التأجيل اكثر من 20 يوما للقسط الواحد',
            ]);
        }

        $request->validate([
            'id' => 'required|exists:invoice_installments,id',
            'days_count' => ['required', 'numeric', 'max:' . $validation_dys],
        ]);

        $new_date = Carbon::parse($installment->pay_date)->addDays($request->days_count)->format('Y-m-d');

        $installment->history()->create([
            'description' => '  تأجيل القسط من يوم ' . $installment->pay_date . ' الى يوم ' . $new_date . '',
            'invoice_id' => $installment->invoice_id,
            'admin_id' => auth()->user()->id,
        ]);

        $installment->pay_date = $new_date;
        $installment->moved_days += $request->days_count;
        $installment->status = InvoiceInstallmentsStatusEnum::delayed->value;
        $installment->save();
        return response()->json(['status' => true, 'msg' => 'تم التأجيل بنجاح '], 200);
    }

    public function monthPostingInstallment(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:invoice_installments,id',
            ]);
            $installment = InvoiceInstallments::find($request->id);
            $next_bill_id = $request->id + 1;
            $next_bill = InvoiceInstallments::where('id', $next_bill_id)->where('invoice_id', $installment->invoice_id)->first();
            if (!$next_bill) {
                return response()->json(['status' => false, 'msg' => 'لا يوجد قسط قادم للترحيله اليه القسط الحالي'], 200);
            }

//        $new_date = Carbon::parse($installment->pay_date)->addMonth(1)->format('Y-m-d');

            $installment->history()->create([
                'description' => ' تم ترحيل القسط ودمجه مع القسط القادم ',
                'invoice_id' => $installment->invoice_id,
                'admin_id' => auth()->user()->id,
            ]);

            $next_bill->paid_amount = $next_bill->paid_amount + $installment->paid_amount;
            $next_bill->monthly_installment = $next_bill->monthly_installment + $installment->monthly_installment;
            $next_bill->save();

            $installment->monthly_installment = 0;
            $installment->paid_amount = 0;
            $installment->status = InvoiceInstallmentsStatusEnum::deported->value;
            $installment->save();



         $next_bill->history()->create([
             'description' => 'تم دمج القسط السابق مع القسط المحدد ',
             'invoice_id' => $next_bill->invoice_id,
             'admin_id' => auth()->user()->id,
         ]);

        return response()->json(['status' => true, 'msg' => 'تم الترحيل'], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex], 200);

        }

    }

    public function pay(Request $request)
    {
        $invoice = Invoice::with('installments')->findOrFail($request->invoice_id);
        $installments = $invoice->installments();
        $sum_monthly_installment = $installments->sum('monthly_installment');
        $sum_paid_amount = $installments->sum('paid_amount');
        $sum_remaining_amount = $sum_monthly_installment - $sum_paid_amount;

        $request->validate([
            'amount' => 'required|numeric|gt:' . '0' . '|lte:' . $sum_remaining_amount,
        ]);

        $amount = (float)$request->amount;

        $invoice_law_suits = $invoice->unPaidLawSuit;

        if (count($invoice_law_suits) > 0) {
            foreach ($invoice_law_suits as $invoice_law_suit) {
                $pay_amount = $invoice_law_suit->amount - $invoice_law_suit->paid_amount;
                if ($amount >= $pay_amount) {
                    $added_amount = $invoice_law_suit->paid_amount += $pay_amount;
                    $amount = $amount - $pay_amount;
                    $invoice_law_suit->status = InvoiceInstallmentsStatusEnum::PAID->value;
                    $invoice_law_suit->save();
                } else {
                    $added_amount = $invoice_law_suit->paid_amount += $amount;
                    $invoice_law_suit->save();
                    $amount = 0;
                }

                $invoice_law_suit->fresh();
                $invoice_law_suit->histories()->create([
                    'description' => '  دفع مبلغ ' . $invoice_law_suit->paid_amount . ' من القسط رقم ' . $invoice_law_suit->id . 'من اصل ' . $pay_amount . ' , ',
                    'admin_id' => auth()->user()->id,
                ]);

                DailyHistory::create([
                    'description' => 'تم دفع من حساب قضيه رقم ' . $invoice_law_suit->id . ' مبلغ ' . $added_amount . ' من اصل ' . $pay_amount . ' , ',
                    'admin_id' => auth()->user()->id,
                ]);

                if ($amount <= 0) {
                    break;
                }
            }
        }
        if ($amount > 0) {
            $remain_installments = $installments->where('status', InvoiceInstallmentsStatusEnum::UNPAID->value)->get();
            $daily_history = '';
            if (count($remain_installments) > 0) {
                foreach ($remain_installments as $installment) {
                    $pay_amount = $installment->monthly_installment - $installment->paid_amount;
                    if ($amount >= $pay_amount) {
                        $installment->paid_amount += $pay_amount;
                    } else {
                        $installment->paid_amount += $amount;
                        $amount = 0;
                    }
                    $installment->save();
                    $installment->fresh();
                    if ($pay_amount == $installment->paid_amount || $installment->monthly_installment == $installment->paid_amount) {
                        $installment->status = InvoiceInstallmentsStatusEnum::PAID->value;
                    }
                    $installment->save();
                    $installment->fresh();

                    $history = $installment->history()->create([
                        'description' => '  دفع مبلغ ' . $installment->paid_amount . ' من القسط رقم ' . $installment->id . 'من اصل ' . $installment->monthly_installment . ' , ',
                        'invoice_id' => $installment->invoice_id,
                        'admin_id' => auth()->user()->id,
                    ]);
                    $amount = $amount - $installment->monthly_installment;
                    $daily_history = $daily_history . $history->description . ' رقم ' . $installment->id;
                    if ($amount <= 0) {
                        $daily_history = $daily_history . ' وتم الدفع بنجاح' . ' , ';
                        $daily_history = $daily_history . 'الخاص بمنتج ' . $invoice->product;
                        DailyHistory::create([
                            'description' => $daily_history,
                            'admin_id' => auth()->user()->id,
                        ]);
                        break;
                    }
                }
            }
            $sum_remaining_amount = $sum_remaining_amount - $request->amount;
            $sum_remaining_amount = number_format((float)$sum_remaining_amount, 2, '.', '');
        }
        return response()->json(['new_amount' => $sum_remaining_amount], 200);


    }


}
