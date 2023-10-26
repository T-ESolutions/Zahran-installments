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
                <span class="font-weight-bold mr-2">@lang('lang.transaction_number') </span>
                <span class="font-weight-bold ">{{$invoice->transaction_number}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.product') </span>
                <span class="font-weight-bold ">{{$invoice->product}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.total_price') </span>
                <span class="font-weight-bold ">{{$invoice->total_price}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.deposit') </span>
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
                                                class="font-weight-bold mr-2">@lang('lang.monthly_profit_percent') </span>
                <span
                    class="font-weight-bold ">{{$invoice->monthly_profit_percent}} %</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.profit') </span>
                <span class="font-weight-bold ">{{$invoice->profit}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2 text-danger">
                <span class="font-weight-bold mr-2">@lang('lang.remaining_price') </span>
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

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.phone2') </span>
                <span class="font-weight-bold ">{{$invoice->customer->phone2}}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">@lang('lang.phone3') </span>
                <span class="font-weight-bold ">{{$invoice->customer->phone3}}</span>
            </div>


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

        </div>
    </div>

</div>