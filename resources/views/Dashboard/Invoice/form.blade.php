<div class="card-body row">

    <div class="form-group  col-4">
        <label>{{trans('lang.invoice_number')}}</label>
        <input name="invoice_number" placeholder="{{trans('lang.invoice_number')}}"
               value="{{ old('invoice_number', $data->invoice_number ?? '') }}"
               class="form-control  {{ $errors->has('invoice_number') ? 'border-danger' : '' }}" type="text"
               maxlength="255"/>

        @if($errors->has('invoice_number'))
            <span class="text-danger m-2 ">{{ $errors->first('invoice_number') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.pay_day')}}<span
                class="text-danger">*</span></label>
        <input name="pay_day" id="pay_day" placeholder="{{trans('lang.pay_day')}}"
               value="{{ old('pay_day', $data->pay_day ?? '') }}"
               class="form-control  {{ $errors->has('pay_day') ? 'border-danger' : '' }}" type="number"
               maxlength="255"/>

        @if($errors->has('pay_day'))
            <span class="text-danger m-2 ">{{ $errors->first('pay_day') }}</span>
        @endif
    </div>
    <div class="form-group  col-lg-4 col-sm-4 ">
        <label>{{trans('lang.customer')}}</label>
        <div class="  {{ $errors->has('customer_id') ? ' border  border-danger rounded' : '' }}">
            <select name="customer_id"
                    class="form-control select2"
                    id="customer_select">
                <option selected disabled></option>
                @foreach($customers as $row)
                    <option
                        @if(Request::segment(3)== 'invoices' && Request::segment(5)== 'edit')
                            {{ $row->id == old('customer_id',  $data->customer_id)  ? 'selected' : '' }}
                        @else
                            {{ $row->id == old('customer_id') ? 'selected' : '' }}
                        @endif
                        value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        @if($errors->has('customer_id'))
            <span class="text-danger m-2 ">{{ $errors->first('customer_id') }}</span>
        @endif
    </div>


    <div class="form-group  col-4">
        <label>{{trans('lang.transaction_number')}}</label>
        <input name="transaction_number" id="transaction_number" disabled
               placeholder="{{trans('lang.transaction_number')}}"
               value="{{ old('transaction_number', $data->transaction_number ?? '') }}"
               class="form-control  {{ $errors->has('transaction_number') ? 'border-danger' : '' }}" type="text"
               maxlength="255"/>

        @if($errors->has('transaction_number'))
            <span class="text-danger m-2 ">{{ $errors->first('transaction_number') }}</span>
        @endif
    </div>
    <div class="form-group  col-4">
        <label>{{trans('lang.invoice_date')}}<span
                class="text-danger">*</span></label>
        <input name="invoice_date" placeholder="{{trans('lang.invoice_date')}}"
               value="{{ old('invoice_date', $data->invoice_date ?? '') }}"
               class="form-control  {{ $errors->has('invoice_date') ? 'border-danger' : '' }}" type="date"
               maxlength="255"/>

        @if($errors->has('invoice_date'))
            <span class="text-danger m-2 ">{{ $errors->first('invoice_date') }}</span>
        @endif
    </div>
    <div class="form-group  col-4">
        <label>{{trans('lang.product')}}</label>
        <textarea name="product" placeholder="{{trans('lang.product')}}"
                  class="form-control  {{ $errors->has('product') ? 'border-danger' : '' }}" type="text"
                  maxlength="255">{{ old('product', $data->product ?? '') }}</textarea>

        @if($errors->has('product'))
            <span class="text-danger m-2 ">{{ $errors->first('product') }}</span>
        @endif
    </div>
    <div class="form-group  col-4">
        <label>{{trans('lang.note')}}</label>
        <textarea name="note" placeholder="{{trans('lang.note')}}"
                  class="form-control  {{ $errors->has('note') ? 'border-danger' : '' }}" type="text"
                  maxlength="255">{{ old('note', $data->note ?? '') }}</textarea>

        @if($errors->has('note'))
            <span class="text-danger m-2 ">{{ $errors->first('note') }}</span>
        @endif
    </div>
    <div class="form-group  col-lg-4 col-sm-4 ">
        <label>{{trans('lang.guarantors')}}</label>
        <div class="  {{ $errors->has('guarantors_id') ? ' border  border-danger rounded' : '' }}">
            <select name="guarantors_id"
                    class="form-control select2"
                    id="guarantors_select" multiple>
                <option selected disabled></option>
                @foreach($customers as $row)
                    <option @if(Request::segment(3)== 'invoices' && Request::segment(5)== 'edit')
                                {{ $row->id == old('guarantors_id',  $data->guarantors_id)  ? 'selected' : '' }}
                            @else
                                {{ $row->id == old('guarantors_id') ? 'selected' : '' }}
                            @endif
                            value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        @if($errors->has('guarantors_id'))
            <span class="text-danger m-2 ">{{ $errors->first('guarantors_id') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.total_price')}}<span
                class="text-danger">*</span></label>
        <input name="total_price" id="total_price" placeholder="{{trans('lang.total_price')}}"
               value="{{ old('total_price', $data->total_price ?? '') }}"
               class="form-control  {{ $errors->has('total_price') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255"/>

        @if($errors->has('total_price'))
            <span class="text-danger m-2 ">{{ $errors->first('total_price') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.deposit')}}<span
                class="text-danger">*</span></label>
        <input name="deposit" id="deposit" placeholder="{{trans('lang.deposit')}}"
               value="{{ old('deposit', $data->deposit ?? '') }}"
               class="form-control  {{ $errors->has('deposit') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255"/>

        @if($errors->has('deposit'))
            <span class="text-danger m-2 ">{{ $errors->first('deposit') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.remaining_price')}}<span
                class="text-danger">*</span></label>
        <input name="remaining_price" disabled id="remaining_price" placeholder="{{trans('lang.remaining_price')}}"
               value="{{ old('remaining_price', $data->remaining_price ?? '') }}"
               class="form-control  {{ $errors->has('remaining_price') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255"/>

        @if($errors->has('remaining_price'))
            <span class="text-danger m-2 ">{{ $errors->first('remaining_price') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.monthly_profit_percent')}}<span
                class="text-danger">*</span></label>
        <input name="monthly_profit_percent" id="monthly_profit_percent"
               placeholder="{{trans('lang.monthly_profit_percent')}}"
               value="{{ old('monthly_profit_percent', $data->monthly_profit_percent ?? $monthly_profit_percent ??   '' ) }}"
               class="form-control  {{ $errors->has('monthly_profit_percent') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255"/>

        @if($errors->has('monthly_profit_percent'))
            <span class="text-danger m-2 ">{{ $errors->first('monthly_profit_percent') }}</span>
        @endif
    </div>


    <div class="form-group  col-4">
        <label>{{trans('lang.months_count')}}<span
                class="text-danger">*</span></label>
        <input name="months_count" id="months_count" placeholder="{{trans('lang.months_count')}}"
               value="{{ old('months_count', $data->months_count ?? '') }}"
               class="form-control  {{ $errors->has('months_count') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255"/>

        @if($errors->has('months_count'))
            <span class="text-danger m-2 ">{{ $errors->first('months_count') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.monthly_installment')}}<span
                class="text-danger">*</span></label>
        <input name="monthly_installment" id="monthly_installment" placeholder="{{trans('lang.monthly_installment')}}"
               value="{{ old('monthly_installment', $data->monthly_installment ?? '') }}"
               class="form-control  {{ $errors->has('monthly_installment') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255"/>

        @if($errors->has('monthly_installment'))
            <span class="text-danger m-2 ">{{ $errors->first('monthly_installment') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.profit')}}<span
                class="text-danger">*</span></label>
        <input name="profit" id="profit" placeholder="{{trans('lang.profit')}}"
               value="{{ old('profit', $data->profit ?? '') }}"
               class="form-control  {{ $errors->has('profit') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255"/>

        @if($errors->has('profit'))
            <span class="text-danger m-2 ">{{ $errors->first('profit') }}</span>
        @endif
    </div>

</div>
<div class="card-footer text-left">
    <button type="Submit" id="submit" class="btn btn-primary btn-default ">{{trans('lang.save')}}</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">{{trans('lang.cancel')}}</a>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>

    <script !src="">
        $('#kt_select2_2_modal').select2({
            placeholder: `{{trans('lang.guarantor')}}`,
            tags: true
        });
        $('#guarantors_select').select2({
            placeholder: `{{trans('lang.guarantors')}}`,
            tags: true
        });
        $('#customer_select').select2({
            placeholder: `{{trans('lang.customer')}}`,
            tags: true
        });
        var avatar1 = new KTImageInput('kt_image_1');



        $("#pay_day").on("input", function() {
            var inputValue = parseFloat($("#pay_day").val());
            if (isNaN(inputValue) || inputValue < 1 || inputValue > 30) {
                 $("#pay_day").val("");
            }
        });


        $("#total_price").on("input", function() {
            var inputValue = parseFloat($("#total_price").val());
            if (isNaN(inputValue) || inputValue < 1 ) {
                 $("#total_price").val("");
            }
        });


        $("#deposit").on("input", function() {
            var inputValue = parseFloat($("#deposit").val());
            if (isNaN(inputValue) || inputValue < 1 ) {
                 $("#deposit").val("");
            }
        });



        $("#monthly_profit_percent").on("input", function() {
            var inputValue = parseFloat($("#monthly_profit_percent").val());
            if (isNaN(inputValue) || inputValue < 1 ) {
                 $("#monthly_profit_percent").val("");
            }
        });


        $("#monthly_installment").on("input", function() {
            var inputValue = parseFloat($("#monthly_installment").val());
            if (isNaN(inputValue) || inputValue < 1 ) {
                 $("#monthly_installment").val("");
            }
        });


        $("#months_count").on("input", function() {
            var inputValue = parseFloat($("#months_count").val());
            if (isNaN(inputValue) || inputValue < 1 ) {
                 $("#months_count").val("");
            }
        });





        let pay_day = null
        let customer = null
        let profit = null
        let monthly_installment = null
        let monthly_profit_percent = $('#monthly_profit_percent').val()
        let remaining_price = null
        let deposit = null
        let total_price = null
        let months_count = null

        $("#months_count").on("change", function (e) {
            months_count = e.target.value
            monthlyInstallment()

        });


        $("#total_price").on("change", function (e) {
            total_price = e.target.value
            remainingPrice()
        });
        $("#deposit").on("change", function (e) {
            deposit = e.target.value
            remainingPrice()
        });
        $("#remaining_price").on("change", function (e) {
            remaining_price = e.target.value
        });

        $("#monthly_installment").on("change", function (e) {
            monthly_installment = e.target.value
            reverseMonthlyInstallment()
        });
        $("#profit").on("change", function (e) {
            profit = e.target.value
        });
        $("#customer_select").on("change", function (e) {
            customer = e.target.value
            TransactionNumber()
        });
        $("#pay_day").on("change", function (e) {
            pay_day = e.target.value
            TransactionNumber()
        });


        function TransactionNumber() {
            if (pay_day && customer) {
                $("#transaction_number").val(pay_day + '.' + customer);
            }
        }

        function remainingPrice() {

            if (total_price && deposit) {
                if (total_price < deposit) {
                    Swal.fire({
                        icon: 'error',
                        title: 'السعر الكلي يجب ان يكون اكبر من المقدم',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'تم'
                    })
                } else {
                    remaining_price = total_price - deposit;
                    $("#remaining_price").val(total_price - deposit);
                }
            }
        }

        function monthlyInstallment() {


            if (monthly_profit_percent && remaining_price && months_count) {

                let eq_percent =( monthly_profit_percent / 100) / 12;
                let eq_month_percent = eq_percent * months_count;
                let eq_additional_money = eq_month_percent * remaining_price
                let eq_total_money = eq_additional_money + remaining_price
                let eq_every_month = eq_total_money / months_count

                eq_every_month  = eq_every_month.toFixed(2);
                monthly_installment=eq_every_month



                $("#monthly_installment").val(eq_every_month);

            }
        }
        function reverseMonthlyInstallment() {

            if (monthly_profit_percent && remaining_price && months_count ) {

                monthly_profit_percent=((((months_count*monthly_installment) - remaining_price) / remaining_price  ) / months_count ) * 12 * 100

                monthly_profit_percent = monthly_profit_percent.toFixed(2);

                if(monthly_profit_percent < 0 )
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'لا يكن ان يكون عدد الاشهر ' + monthly_installment,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'تم'
                    })

                    $("#monthly_installment").val(null);
                }else{

                    $("#monthly_profit_percent").val(monthly_profit_percent);

                }

            }
        }


    </script>

@endpush
