<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\InvoiceExecutionDataTable;
use App\DataTables\Dashboard\InvoiceInstallmentsDataTable;
use App\Enums\InvoiceInstallmentsStatusEnum;
use App\Http\Requests\Dashboard\FinishCashRequest;
use App\Http\Requests\Dashboard\InvoiceCreateRequest;
use App\DataTables\Dashboard\InvoiceDataTable;
use App\Models\Customer;
use App\Models\DailyHistory;
use App\Models\InvoiceInstallments;
use App\Models\InvoiceInstallmentsHistory;
use App\Models\Notification;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\GeneralController;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Alkoumi\LaravelArabicNumbers\Numbers;

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

    public function getExecution(InvoiceExecutionDataTable $dataTable)
    {

        return $dataTable->render('Dashboard.Invoice.execution');
    }

    public function getMonthDivision($month_count, $installment_amount)
    {

        return view('Dashboard.Invoice.parts.month_division', compact('month_count', 'installment_amount'));
    }

    public function create()
    {
        $monthly_profit_percent = settings('monthly_profit_percent');
        $customers = Customer::WhiteList()->orderBy('id', 'desc')->get(['id', 'name']);
        return view('Dashboard.Invoice.create', compact('monthly_profit_percent', 'customers'));
    }

    public function store(InvoiceCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['admin_id'] = auth()->user()->id;
//            $data['transaction_number'] = $request->pay_day . '.' . $request->customer_id;

            if ($data['paper_amount'] == "") {
                $data['paper_amount'] = 0;
            }
            if ($data['division_type'] == 'manual') {
                if ($request->total_sum_division_prices != $data['installment_price']) {
                    return response()->json(['status' => false, 'msg' => 'يجب ان يكون مجموع الاقساط المدخله يدويا يساوي اجمالي سعر القسط'], 200);

                }
            }
            $invoice = Invoice::create($data);
            if ($data['invoice_type'] == 1) {
                //general data to store
                $tafqeet = Numbers::TafqeetMoney($data['paper_amount'], 'EGP');
                $paper_data['invoice_id'] = $invoice->id;
                $paper_data['paper_amount'] = $invoice->paper_amount;
                $paper_data['paper_amount_txt'] = $tafqeet;

                //save customer first ...
                $paper_data['customer_id'] = $invoice->customer_id;
                Paper::create($paper_data);

                //save guarantors customer first ...
                if (isset($data['guarantors_id'])) {
                    foreach ($data['guarantors_id'] as $guarantor) {
                        $paper_data['customer_id'] = $guarantor;
                        Paper::create($paper_data);
                    }
                }
            }
            if ($request->guarantors_id) {
                $invoice->guarantors()->attach($request->guarantors_id);
            }
            if ($data['division_type'] == 'dynamic') {
                $this->createInstallments($invoice, $data);

            } else {
                $this->createInstallmentsManual($invoice, $data);
            }
            DB::commit();
            Session::flash('success', trans('lang.created'));
//            return response()->json([], 200);
            return response()->json(['status' => true, 'id' => $invoice->id], 200);
        } catch (\Exception $e) {
            dd($e);
            info($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

    public function print_insurance_paper(Paper $paper)
    {

        return view('Dashboard.Invoice.print', compact('paper'));
    }

    private function createInstallments($invoice, $data)
    {
        $months_count = $data['months_count'];
        $monthly_installment = $data['monthly_installment'];
        $pay_day = $data['pay_day'];
        $invoice_date = $data['invoice_date'];
        $invoice_date = Carbon::parse($invoice_date);
        for ($i = 0; $i < $months_count; $i++) {
            $pay_date = $invoice_date->addMonth(1)->day($pay_day);
            $installment = $invoice->installments()->create([
                'pay_date' => $pay_date,
                'monthly_installment' => $monthly_installment,
            ]);
            $installment->history()->create([
                'description' => '  انشاء قسط بمبلغ ' . $monthly_installment . ' وتاريخ الدفع ' . $pay_date->format('Y-m-d') . '',
                'invoice_id' => $invoice->id,
                'admin_id' => auth()->user()->id,
            ]);
        }
    }

    private function createInstallmentsManual($invoice, $data)
    {
        $months_count = $data['months_count'];
        $started_pay = $data['pay_year'] . '-' . $data['pay_month'] . '-' . $data['pay_day'];
        $started_pay = strtotime($started_pay);
        $started_pay = date("Y-m-d", $started_pay);
        $pay_date = Carbon::parse($started_pay);
        for ($i = 0; $i < $months_count; ++$i) {
            $installment = $invoice->installments()->create([
                'pay_date' => $pay_date,
                'monthly_installment' => $data['installment_price_divided'][$i],
            ]);
            $installment->history()->create([
                'description' => '  انشاء قسط بمبلغ ' . $data['installment_price_divided'][$i] . ' وتاريخ الدفع ' . $pay_date->format('Y-m-d') . '',
                'invoice_id' => $invoice->id,
                'admin_id' => auth()->user()->id,
            ]);
            $pay_date = $pay_date->addMonth(1);
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

//        make seen notification
        $exist_notify = Notification::where('route', 'invoices.installments')->where('target_id', $id)->where('is_seen', 0)->first();
        if ($exist_notify) {
            $exist_notify->is_seen = 1;
            $exist_notify->save();
        }
        return $dataTable->with(['id' => $id])->render('Dashboard.Invoice.indexInstallments', compact('invoice', 'sum_remaining_amount'));
    }

    public function changeInstallmentDate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:invoice_installments,id',
            'pay_date' => ['required', 'date', 'after_or_equal:today'],
        ]);
        $installment = InvoiceInstallments::find($request->id);
        if ($installment->invoice->status == 3) {

            return response()->json(['status' => false, 'msg' => 'لا يمكن تعديل التاريخ - الفاتورة منتهية'], 200);
        }
        $installment->history()->create([
            'description' => '  تغيير موعد القسط من يوم ' . $installment->pay_date . ' الى يوم ' . $request->pay_date . '',
            'invoice_id' => $installment->invoice_id,
            'admin_id' => auth()->user()->id,
        ]);

        $installment->pay_date = $request->pay_date;
        $installment->save();
        return response()->json([], 200);
    }

    public function add_notes(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:invoice_installments,id',
            'notes' => ['required', 'string', 'max:6000'],
        ]);
        $installment = InvoiceInstallments::find($request->id);

        $installment->history()->create([
            'description' => 'تم اضافة ملاحظات -' . $request->notes,
            'invoice_id' => $installment->invoice_id,
            'admin_id' => auth()->user()->id,
        ]);

        $installment->notes = $request->notes;
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

            if ($installment->invoice->status == 3) {
                return response()->json(['status' => false, 'msg' => 'لا يمكن التأجيل - الفاتورة منتهية'], 200);
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
            if ($installment->invoice->status == 3) {
                return response()->json(['status' => false, 'msg' => 'لا يمكن الترحيل - الفاتورة منتهية'], 200);
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
            return response()->json(['status' => false, 'msg' => $ex], 200);

        }

    }

    public function monthExcuse(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:invoice_installments,id',
            ]);
            $installment = InvoiceInstallments::find($request->id);
            if ($installment->invoice->status == 3) {
                return response()->json(['status' => false, 'msg' => 'لا يمكن اضافة السماحية - الفاتورة منتهية'], 200);
            }
            //لا يمكن اضافة سماحية لقسط مرحل
            if ($installment->status == 7) {
                return response()->json(['status' => false, 'msg' => 'لا يمكن اضافة سماحية لقسط مرحل'], 200);
            }
            if ($installment->status == 8) {
                return response()->json(['status' => false, 'msg' => 'لا يمكن اضافة سماحية لقسط مأجل بالسماحية من قبل'], 200);
            }

            if ($installment->status == 9) {
                return response()->json(['status' => false, 'msg' => 'لا يمكن اضافة سماحية لقسط منتهي بالخصم'], 200);
            }

            $invoice = Invoice::find($installment->invoice_id);
            if ($invoice->excuse_1 == null || $invoice->excuse_2 == null) {

                $last_bill = InvoiceInstallments::where('invoice_id', $installment->invoice_id)->orderBy('pay_date', 'desc')->first();


//        $new_date = Carbon::parse($installment->pay_date)->addMonth(1)->format('Y-m-d');
                $pay_date = Carbon::parse($last_bill->pay_date);
                $pay_date = $pay_date->addMonth(1);
                $new_installment_data['invoice_id'] = $installment->invoice_id;
                $new_installment_data['pay_date'] = $pay_date;
                $new_installment_data['monthly_installment'] = $installment->monthly_installment;
                $new_installment_data['paid_amount'] = $installment->paid_amount;
                $new_installment_data['status'] = 2;


                $new_installment = InvoiceInstallments::create($new_installment_data);
                $installment->monthly_installment = 0;
                $installment->paid_amount = 0;
                $installment->status = InvoiceInstallmentsStatusEnum::excuse->value;
                $installment->save();

                $installment->history()->create([
                    'description' => ' تم تأجيل بالسماحية واضافة شهر اضافي في الفاتورة',
                    'invoice_id' => $installment->invoice_id,
                    'admin_id' => auth()->user()->id,
                ]);
                $new_installment->history()->create([
                    'description' => 'تم اضافة شهر اضافي في الفاتورة بالسماحية ',
                    'invoice_id' => $installment->invoice_id,
                    'admin_id' => auth()->user()->id,
                ]);
                if ($invoice->excuse_1 == null) {
                    $invoice->excuse_1 = $pay_date;
                } elseif ($invoice->excuse_2 == null) {
                    $invoice->excuse_2 = $pay_date;
                }
                $invoice->save();
                return response()->json(['status' => true, 'msg' => 'تم الترحيل'], 200);
            } else {
                return response()->json(['status' => false, 'msg' => 'لا يمكن اضافة السماحية لانها استخدمت مرتين في الفاتوره الحالية'], 200);

            }
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' => $ex], 200);

        }

    }

    public function finish(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:invoices,id',
            ]);
            $id = $request->id;
            $installment = InvoiceInstallments::where('invoice_id', $id)->whereIn('status', [2, 3, 4, 5, 6])->first();

            $invoice = Invoice::whereId($id)->first();

            if ($invoice->invoice_type == 3) {
                if ($invoice->invoice->status != Invoice::FINISHED) {
                    return response()->json(['status' => false, 'msg' => 'لا يمكن انهاء الفاتورة - لانها مربوطة بوصلات امانة فاتورة اخرى رقم  ' . $invoice->invoice_id], 200);
                }
            }

            if ($installment) {
                return response()->json(['status' => false, 'msg' => 'لا يمكن انهاء الفاتورة - يتم انهاء الفاتوره عند دفع كل الاقساط اولا  '], 200);
            }

            $invoice_law_suits = $invoice->unPaidLawSuit;
            if (count($invoice_law_suits) > 0) {
                return response()->json(['status' => false, 'msg' => 'لا يمكن انهاء الفاتورة - لان يوجد مصاريف قضائية على الفاتورة المختاره '], 200);
            }

            $history_data['description'] = 'تم انهاء الفاتورة';
            $history_data['invoice_id'] = $id;
            $history_data['admin_id'] = auth()->user()->id;
            InvoiceInstallmentsHistory::create($history_data);

            return response()->json(['status' => true, 'msg' => 'تم الانهاء بنجاح'], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' => $ex], 200);
        }

    }

    public function execution(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:invoices,id',
            ]);
            $id = $request->id;
            $invoice = Invoice::whereId($id)->first();
            $invoice->status = 4;
            $invoice->save();

            $history_data['description'] = 'تم اعدام الفاتورة';
            $history_data['invoice_id'] = $id;
            $history_data['admin_id'] = auth()->user()->id;
            InvoiceInstallmentsHistory::create($history_data);
            return response()->json(['status' => true, 'msg' => 'تم الاعدام بنجاح'], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' => $ex], 200);
        }

    }

    public function updateNote(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:invoices,id',
            'note' => 'required|string|max:6000',
        ]);
        $id = $request->id;
        $invoice = Invoice::whereId($id)->first();
        $invoice->note = $request->note;
        $invoice->save();

        $history_data['description'] = 'تم التعديل على بيانات ملاحظات الفاتورة';
        $history_data['invoice_id'] = $id;
        $history_data['admin_id'] = auth()->user()->id;
        InvoiceInstallmentsHistory::create($history_data);
        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    public function finishCash(FinishCashRequest $request)
    {
        try {

            $data = $request->validated();

            $invoice = Invoice::whereId($data['id'])->first();

            if ($invoice->invoice_type == 3) {
                if ($invoice->invoice->status != Invoice::FINISHED) {
                    return response()->json(['status' => false, 'msg' => 'لا يمكن انهاء الفاتورة - لانها مربوطة بوصلات امانة فاتورة اخرى رقم  ' . $invoice->invoice_id], 200);
                }
            }

            $invoice_law_suits = $invoice->unPaidLawSuit;
            if (count($invoice_law_suits) > 0) {
                return response()->json(['status' => false, 'msg' => 'لا يمكن انهاء الفاتورة - لان يوجد مصاريف قضائية على الفاتورة المختاره '], 200);
            }

            $invoice->status = Invoice::FINISHED;
            $invoice->save();

            foreach ($invoice->remain_installments as $row) {
                InvoiceInstallments::where('id', $row->id)->update(['status' => 9]);
            }


            $data['status'] = Invoice::FINISHED;
            Invoice::whereId($data['id'])->update($data);


            $history_data['description'] = 'تم انهاء الفاتورة كاش و تنفيذ خصم بقيمة : ' . $data['discount_value'];
            $history_data['invoice_id'] = $data['id'];
            $history_data['admin_id'] = auth()->user()->id;
            InvoiceInstallmentsHistory::create($history_data);

            DailyHistory::create([
                'description' => $data['discount_money_collected'] . ' جنية باقي تقفيل اقساط الفاتورة رقم ' . $data['id'] . ' طرف / '
                    . $invoice->customer->name . ' وتم خصم من الاجمالي ' . $data['discount_value'] . ' جنية',
                'admin_id' => auth()->user()->id,
            ]);

            return response()->json(['status' => true, 'msg' => 'تم الانهاء بنجاح'], 200);
        } catch (\Exception $ex) {

            return response()->json(['status' => false, 'msg' => $ex], 200);

        }

    }

    public function pay(Request $request)
    {
        $invoice = Invoice::with('installments')->findOrFail($request->invoice_id);

        $total_paid = $invoice->installments()->sum('paid_amount');
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
            $law_daily_history_description = ' سداد مصاريف ';
            foreach ($invoice_law_suits as $invoice_law_suit) {
                $pay_amount = $invoice_law_suit->amount - $invoice_law_suit->paid_amount;
                if ($amount >= $pay_amount) {
                    $added_amount = $invoice_law_suit->paid_amount += $pay_amount;
                    $amount = $amount - $pay_amount;
                    $law_mins_amount = $pay_amount;
                    $invoice_law_suit->status = InvoiceInstallmentsStatusEnum::PAID->value;
                    $invoice_law_suit->save();
                } else {
                    $added_amount = $invoice_law_suit->paid_amount += $amount;
                    $law_mins_amount = $amount;
                    $invoice_law_suit->save();
                    $amount = 0;
                }

                $invoice_law_suit->fresh();
                $invoice_law_suit->histories()->create([
                    'description' => '  دفع مبلغ ' . $law_mins_amount . ' جنية من القضية رقم ' . $invoice_law_suit->id . 'من اصل ' . $pay_amount . ' , ',
                    'admin_id' => auth()->user()->id,
                ]);
                $law_daily_history_description = $law_daily_history_description . ' قضية رقم ' . $invoice_law_suit->id . ' بقيمة ' . $law_mins_amount . ' جنية , ';


                if ($amount <= 0) {
                    break;
                }
            }
            $law_daily_history_description = $law_daily_history_description . ' عن الفاتورة رقم ' . $request->invoice_id;

            DailyHistory::create([
                'description' => $law_daily_history_description,
                'admin_id' => auth()->user()->id,
            ]);
        }
        if ($total_paid == 0) {

            $daily_description = $amount . ' جنية بداية قسط طرف / ' . $invoice->customer->name . ' لفاتورة ' . $invoice->product . ' بقيمة ' . $invoice->total_price .
                ' جنية و مقدم ' . $invoice->deposit . ' جنية - تقسيمة المدفوع  ';
        } else {
            $daily_description = $amount . ' جنية  قسط طرف / ' . $invoice->customer->name . '  - تقسيمة المدفوع  ';
        }
        if ($amount > 0) {
            $remain_installments = $installments->whereIn('status', [2, 3, 4, 5, 6])->get();
            $daily_history = '';
            if (count($remain_installments) > 0) {
                foreach ($remain_installments as $installment) {
                    $pay_amount = $installment->monthly_installment - $installment->paid_amount; // 645 - 0
                    if ($amount >= $pay_amount) {
                        $installment->paid_amount += $pay_amount;
                        $mins_amount = $pay_amount;
                        $amount = $amount - $pay_amount;
                    } else {
                        $mins_amount = $amount;
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
                    $daily_description = $daily_description . $mins_amount . ' جنية من قسط يوم ' . $installment->pay_date . ' , ';

                    $installment->history()->create([
                        'description' => '  دفع مبلغ ' . $mins_amount . ' جنية من القسط  ',
                        'invoice_id' => $installment->invoice_id,
                        'admin_id' => auth()->user()->id,
                    ]);

                    if ($amount <= 0) {
                        break;
                    }

                }
                $daily_description = $daily_description . ' عن الفاتورة رقم ' . $request->invoice_id;
                DailyHistory::create([
                    'description' => $daily_description,
                    'admin_id' => auth()->user()->id,
                ]);

            }
            $sum_remaining_amount = $sum_remaining_amount - $request->amount;
            $sum_remaining_amount = number_format((float)$sum_remaining_amount, 2, '.', '');
        }
        $invoice->status = 2;
        $invoice->save();
        return response()->json(['new_amount' => $sum_remaining_amount], 200);


    }


}
