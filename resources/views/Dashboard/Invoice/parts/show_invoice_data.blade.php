<div class="row text-center">
    <div class="col-md-6">
        <div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">رقم الفاتورة</span>
                <span class="font-weight-bold ">{{$invoice->id}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">رقم فاتورة الشراء</span>
                <span class="font-weight-bold ">{{$invoice->invoice_number}}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">{{trans('lang.invoice_date')}}</span>
                <span class="font-weight-bold ">{{$invoice->invoice_date}}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.transaction_number') </span>
                <span class="font-weight-bold ">{{$invoice->transaction_number}}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.pay_day') </span>
                <span class="font-weight-bold ">{{$invoice->pay_day}}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">بداية شهر الدفع </span>
                <span class="font-weight-bold ">{{$invoice->pay_month }}/{{$invoice->pay_year}}</span>
            </div>


            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.product') </span>
                <span class="font-weight-bold ">{{$invoice->product}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">سعر الكاش </span>
                <span class="font-weight-bold ">{{$invoice->total_price}}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">المقدم النهائي </span>
                <span class="font-weight-bold ">{{$invoice->deposit}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.remaining_price') </span>
                <span class="font-weight-bold ">{{$invoice->remaining_price}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span
                                                class="font-weight-bold mr-2">@lang('lang.monthly_installment') </span>
                <span class="font-weight-bold ">{{$invoice->monthly_installment}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span
                                                class="font-weight-bold mr-2">النسبة السنوي </span>
                <span
                    class="font-weight-bold ">{{$invoice->monthly_profit_percent}} %</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">الربح النهائي </span>
                <span class="font-weight-bold ">{{$invoice->profit}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2 text-danger">
                <span class="font-weight-bold mr-2">قيمة الاقساط المتبقية </span>
                <span class="font-weight-bold "
                      id="sum_remaining_amount">{{$sum_remaining_amount}}</span>
            </div>

        </div>
    </div>

    <div class="col-md-6">

        <div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.customer_name') </span>
                <span class="font-weight-bold ">{{$invoice->customer->name}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.phone') </span>
                <span class="font-weight-bold ">{{$invoice->customer->phone}}</span>
            </div>
            @if($invoice->customer->phone2)
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">@lang('lang.phone2') </span>
                    <span class="font-weight-bold ">{{$invoice->customer->phone2}}</span>
                </div>
            @endif
            @if($invoice->customer->phone3)
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">@lang('lang.phone3') </span>
                    <span class="font-weight-bold ">{{$invoice->customer->phone3}}</span>
                </div>
            @endif


            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.id_number') </span>
                <span class="font-weight-bold ">{{$invoice->customer->id_number}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.address_id') </span>
                <span class="font-weight-bold ">{{$invoice->customer->address_id}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.governorate') </span>
                <span class="font-weight-bold ">{{$invoice->customer->governorate}}</span>
            </div>


            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.center') </span>
                <span class="font-weight-bold ">{{$invoice->customer->center}}</span>
            </div>
            @if($invoice->discount_value > 0)
                <hr>
                <h3 class="text-primary">انتهاء الفاتورة كاش</h3>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">نسبة الخصم %</span>
                    <span class="font-weight-bold ">{{$invoice->discount_percentage}}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">عدد اشهر الخصم</span>
                    <span class="font-weight-bold ">{{$invoice->discount_month}}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">السعر المتبقي المنفذ به الخصم</span>
                    <span class="font-weight-bold ">{{$invoice->discount_remain_installments}}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">قيمة الخصم</span>
                    <span class="font-weight-bold ">{{$invoice->discount_value}}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">المبلغ المراد تحصيلة من العميل</span>
                    <span class="font-weight-bold ">{{$invoice->discount_money_collected}}</span>
                </div>
            @endif
        </div>
    </div>

</div>
