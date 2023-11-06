<div class="card-body ">


    <h3 class="text-primary">بيانات العميل والضامنين</h3>
    <div class="row">
        <div class="form-group  col-lg-4 col-sm-4 ">
            <label>{{trans('lang.the_customer')}}</label>
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
            <span class="text-danger errors form_error_customer_id" role="alert"></span>
        </div>
        <div class="form-group  col-lg-4 col-sm-4 ">
            <label>{{trans('lang.guarantors')}}</label>
            <div class="  {{ $errors->has('guarantors_id') ? ' border  border-danger rounded' : '' }}">
                <select name="guarantors_id[]"
                        class="form-control select2"
                        id="guarantors_select" multiple>

                    @foreach($customers as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
            <span class="text-danger errors form_error_guarantors_id" role="alert"></span>
        </div>
    </div>
    <h3 class="text-primary">الضمان</h3>
    <div class="row">
        <div class="form-group  col-lg-4 col-sm-4 ">
            <label>{{trans('lang.guarantor_type')}}</label>
            <div class="  {{ $errors->has('invoice_type') ? ' border  border-danger rounded' : '' }}">
                <select name="invoice_type"
                        class="form-control select2"
                        id="invoice_type">
                    <option selected disabled></option>
                    <option value="{{ \App\Enums\InvoiceTypeEnum::ATTORNEY }}">{{trans('lang.attorney')}} </option>
                    <option value="{{ \App\Enums\InvoiceTypeEnum::INSURANCE }}">{{trans('lang.insurance')}} </option>
                    <option value="{{ \App\Enums\InvoiceTypeEnum::INVOICE }}">وصل امانة من فاتورة قديمة</option>

                </select>
            </div>

            <span class="text-danger errors form_error_invoice_type" role="alert"></span>
        </div>
        <div id="customer_invoices_group" class="form-group  col-lg-4 col-sm-4 d-none">
            <label>{{trans('lang.old_invoice')}}</label>
            <div class="  {{ $errors->has('invoice_type') ? ' border  border-danger rounded' : '' }}">
                <select name="invoice_id"
                        class="form-control select2"
                        id="customer_invoices">
                    <option selected disabled></option>

                </select>
            </div>
            <span class="text-danger errors form_error_invoice_id" role="alert"></span>

        </div>
        <div id="paper_amount_container" class="form-group  col-lg-4 col-sm-4" style="display: none;">
            <label>قيمة وصل الامانة<span class="text-danger">*</span></label>
            <div class="  {{ $errors->has('paper_amount') ? ' border  border-danger rounded' : '' }}">
                <input name="paper_amount" id="paper_amount"
                       value="{{ old('paper_amount', $data->paper_amount ?? '') }}" step="any"
                       class="form-control  {{ $errors->has('paper_amount') ? 'border-danger' : '' }}" type="number"
                       min="0"/>
            </div>
            <span class="text-danger errors form_error_paper_amount" role="alert"></span>

        </div>
    </div>
    <h3 class="text-primary">بيانات الفاتورة</h3>
    <div class="row">
        <div class="form-group  col-2">
            <label>رقم فاتورة الشراء</label>
            <input name="invoice_number"
                   value="{{ old('invoice_number', $data->invoice_number ?? '') }}"
                   class="form-control  {{ $errors->has('invoice_number') ? 'border-danger' : '' }}" type="text"
                   maxlength="255"/>

            <span class="text-danger errors form_error_invoice_number" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>{{trans('lang.invoice_date')}}<span
                    class="text-danger">*</span></label>
            <input name="invoice_date"
                   value="{{ old('invoice_date', $data->invoice_date ?? '') }}"
                   class="form-control  {{ $errors->has('invoice_date') ? 'border-danger' : '' }}" type="date"
                   maxlength="255"/>

            <span class="text-danger errors form_error_invoice_date" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>{{trans('lang.pay_day')}}<span
                    class="text-danger">*</span></label>
            <input name="pay_day" id="pay_day"
                   value="{{ old('pay_day', $data->pay_day ?? '') }}"
                   class="form-control  {{ $errors->has('pay_day') ? 'border-danger' : '' }}" type="number" min="1"
                   max="31"
            />
            <span class="text-danger errors form_error_pay_day" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>بداية شهر الدفع<span
                    class="text-danger">*</span></label>
            <input name="pay_month" id="pay_month"
                   value="{{ old('pay_month', $data->pay_month ?? '') }}"
                   class="form-control  {{ $errors->has('pay_month') ? 'border-danger' : '' }}" type="number" min="1"
                   max="12"
            />
            <span class="text-danger errors form_error_pay_month" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>السنه<span class="text-danger">*</span></label>
            <select name="pay_year"
                    class="form-control"
                    id="pay_year">
                @for($i = 2021; $i < 3030; $i++)
                    <option value="{{$i}}" @if(\Carbon\Carbon::now()->year == $i) selected @endif >{{$i}} </option>
                @endfor

            </select>
            <span class="text-danger errors form_error_pay_year" role="alert"></span>

        </div>
        <div class="form-group  col-2">
            <label>{{trans('lang.transaction_number')}}<span class="text-danger">*</span></label>
            <input name="transaction_number" id="transaction_number" readonly
                   value="{{ old('transaction_number', $data->transaction_number ?? '') }}"
                   class="form-control form-control-solid  {{ $errors->has('transaction_number') ? 'border-danger' : '' }}" type="text"
                   maxlength="255"/>

            <span class="text-danger errors form_error_transaction_number" role="alert"></span>
        </div>

        <div class="form-group  col-6">
            <label>{{trans('lang.product')}}<span
                    class="text-danger">*</span></label>
            <textarea name="product"
                      class="form-control  {{ $errors->has('product') ? 'border-danger' : '' }}" type="text" required
                      maxlength="255">{{ old('product', $data->product ?? '') }}</textarea>

            <span class="text-danger errors form_error_product" role="alert"></span>
        </div>
        <div class="form-group  col-6">
            <label>{{trans('lang.note')}}</label>
            <textarea name="note"
                      class="form-control  {{ $errors->has('note') ? 'border-danger' : '' }}" type="text"
                      maxlength="6000">{{ old('note', $data->note ?? '') }}</textarea>

            <span class="text-danger errors form_error_note" role="alert"></span>
        </div>

        <div class="form-group  col-2">
            <label>سعر الكاش<span class="text-danger">*</span></label>
            <input name="total_price" id="total_price"
                   value="{{ old('total_price', $data->total_price ?? '') }}"
                   class="form-control  {{ $errors->has('total_price') ? 'border-danger' : '' }}"
                   type="number"
                   step="0.01"
            />

            <span class="text-danger errors form_error_total_price" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>المقدم السابق<span
                    class="text-danger">*</span></label>
            <input name="last_deposit" id="last_deposit"
                   value="{{ old('last_deposit', $data->last_deposit ?? '') }}"
                   class="form-control  {{ $errors->has('last_deposit') ? 'border-danger' : '' }}"
                   type="number"
                   step="0.01"
            />

            <span class="text-danger errors form_error_last_deposit" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>المقدم الحالي<span
                    class="text-danger">*</span></label>
            <input name="current_deposit" id="current_deposit"
                   value="{{ old('current_deposit', $data->current_deposit ?? '') }}"
                   class="form-control  {{ $errors->has('current_deposit') ? 'border-danger' : '' }}"
                   type="number"
                   step="0.01"
            />

            <span class="text-danger errors form_error_current_deposit" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>المقدم النهائي<span
                    class="text-danger">*</span></label>
            <input name="deposit" id="deposit" readonly
                   value="{{ old('deposit', $data->deposit ?? '') }}"
                   class="form-control form-control-solid  {{ $errors->has('deposit') ? 'border-danger' : '' }}"
                   type="number"
                   step="0.01"
            />

            <span class="text-danger errors form_error_deposit" role="alert"></span>
        </div>
        <div class="form-group  col-4">
            <label>{{trans('lang.remaining_price')}}<span
                    class="text-danger">*</span></label>
            <input readonly name="remaining_price" id="remaining_price"
                   value="{{ old('remaining_price', $data->remaining_price ?? '') }}"
                   class="form-control form-control-solid {{ $errors->has('remaining_price') ? 'border-danger' : '' }}"
                   type="number"
                   step="any"
            />

            <span class="text-danger errors form_error_remaining_price" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>النسبه السنوي %<span
                    class="text-danger">*</span></label>
            <input name="monthly_profit_percent" id="monthly_profit_percent"
                   value="{{ old('monthly_profit_percent', $data->monthly_profit_percent ?? $monthly_profit_percent ??   '' ) }}"
                   class="form-control  {{ $errors->has('monthly_profit_percent') ? 'border-danger' : '' }}"
                   type="number"
                   step="0.01"
            />
            <span class="text-danger errors form_error_monthly_profit_percent" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>{{trans('lang.months_count')}}<span
                    class="text-danger">*</span></label>
            <input name="months_count" id="months_count"
                   value="{{ old('months_count', $data->months_count ?? '') }}"
                   class="form-control  {{ $errors->has('months_count') ? 'border-danger' : '' }}"
                   type="number" min="1"
            />
            <span class="text-danger errors form_error_months_count" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>النسبه الكلية لعدد الاشهر<span class="text-danger">*</span></label>
            <input name="months_total_percentage" id="months_total_percentage" readonly
                   value="{{ old('months_total_percentage', $data->months_total_percentage ?? '') }}"
                   class="form-control form-control-solid  {{ $errors->has('months_total_percentage') ? 'border-danger' : '' }}"
                   type="number" min="0" step="0.01"
            />
            <span class="text-danger errors form_error_months_total_percentage" role="alert"></span>
        </div>
        <div class="form-group  col-6">
            <label>{{trans('lang.monthly_installment')}}<span
                    class="text-danger">*</span></label>
            <input name="monthly_installment" id="monthly_installment"
                   value="{{ old('monthly_installment', $data->monthly_installment ?? '') }}"
                   class="form-control  {{ $errors->has('monthly_installment') ? 'border-danger' : '' }}"
                   type="number"
                   step="0.01"
            />

            <span class="text-danger errors form_error_monthly_installment" role="alert"></span>

        </div>

        <div class="form-group  col-4">
            <label>نسبة الربح للفاتورة <span class="text-danger">*</span></label>
            <input id="profit_percentage" readonly name="profit_percentage"
                   value="{{ old('profit_percentage', $data->profit_percentage ?? '') }}"
                   class="form-control form-control-solid  {{ $errors->has('profit_percentage') ? 'border-danger' : '' }}"
                   type="number"
                   step="0.01"
            />
            <span class="text-danger errors form_error_profit_percentage" role="alert"></span>
        </div>
        <div class="form-group  col-2">
            <label>الربح النهائي<span class="text-danger">*</span></label>
            <input name="profit" readonly id="profit"
                   value="{{ old('profit', $data->profit ?? '') }}"
                   class="form-control form-control-solid  {{ $errors->has('profit') ? 'border-danger' : '' }}"
                   type="number"
                   step="0.01"
            />
            <span class="text-danger errors form_error_profit" role="alert"></span>
        </div>
        <div class="form-group  col-3">
            <label>اجمالي سعر القسط<span class="text-danger">*</span></label>
            <input id="installment_price" readonly name="installment_price"
                   value="{{ old('installment_price', $data->installment_price ?? '') }}"
                   class="form-control form-control-solid   {{ $errors->has('installment_price') ? 'border-danger' : '' }}"
                   type="number"
                   step="0.01"
            />
            <span class="text-danger errors form_error_installment_price" role="alert"></span>
        </div>
        <div class="form-group  col-3">
            <label>تقسيم يدوي حسب عدد الاشهر<span
                    class="text-danger">*</span></label>
            <input type="hidden" name="division_type" id="txt_division_type" value="dynamic">
            <a class="btn btn-info" id="btn_months_division" href="javascript:void(0)">تقسيم يدوي</a>
        </div>

    </div>
    <div id="division_container" style="display: none;">
        <h3 class="text-primary">التقسيط اليدوي للقسط على عدد الشهور</h3>
        <br>
        <br>
        <div class="row" id="manual_division_container">

        </div>
    </div>

</div>
<div class="card-footer text-left">
    <button id="InvoiceSubmit" class="btn btn-primary btn-default ">{{trans('lang.save')}}</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">{{trans('lang.cancel')}}</a>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <script !src="">
        $('#kt_select2_2_modal').select2({
            placeholder: `{{trans('lang.guarantor')}}`,
            tags: true
        });
        $('#customer_invoices').select2({
            placeholder: `{{trans('lang.customer_invoices')}}`,
            width: '100%',
            tags: true
        });
        $('#guarantors_select').select2({
            placeholder: `{{trans('lang.chose_guarantors')}}`,
            tags: true
        });
        $('#customer_select').select2({
            placeholder: `{{trans('lang.choose_the_customer')}}`,
            tags: true
        });
        $('#invoice_type').select2({
            placeholder: `{{trans('lang.choose_guarantor_type')}}`,
            tags: true
        });
        var avatar1 = new KTImageInput('kt_image_1');

        /*                                  validations                                 */

        $("#pay_day").on("input", function () {
            var inputValue = parseFloat($("#pay_day").val());
            if (isNaN(inputValue) || inputValue < 1 || inputValue > 30) {
                $("#pay_day").val("");
            }
        });
        $("#total_price").on("input", function () {
            var inputValue = parseFloat($("#total_price").val());
            if (isNaN(inputValue) || inputValue < 1) {
                $("#total_price").val("");
            }
        });
        $("#deposit").on("input", function () {
            var inputValue = parseFloat($("#deposit").val());
            if (isNaN(inputValue) || inputValue < 1) {
                $("#deposit").val("");
            }
        });
        $("#monthly_profit_percent").on("input", function () {
            var inputValue = parseFloat($("#monthly_profit_percent").val());
            if (isNaN(inputValue) || inputValue < 1) {
                $("#monthly_profit_percent").val("");
            }
        });
        $("#monthly_installment").on("input", function () {
            var inputValue = parseFloat($("#monthly_installment").val());
            if (isNaN(inputValue) || inputValue < 1) {
                $("#monthly_installment").val("");
            }
        });
        $("#months_count").on("input", function () {
            var inputValue = parseFloat($("#months_count").val());
            if (isNaN(inputValue) || inputValue < 1) {
                $("#months_count").val("");
            }
        });


        /*                                  vars                                 */
        let pay_day = null
        let customer = null
        let profit = null
        let monthly_installment = null
        let monthly_profit_percent = $('#monthly_profit_percent').val()
        let remaining_price = null
        let deposit = null
        let total_price = null
        let months_count = null
        let invoice_type = null
        let last_deposit = null
        let current_deposit = null
        let total_amount = 0;
        $("#invoice_type").on("change", function (e) {
            invoice_type = e.target.value

            if (invoice_type == 1) {
                $("#paper_amount_container").show();
                document.getElementById('paper_amount').setAttribute('required', 'true');

            } else {
                $("#paper_amount_container").hide();
                document.getElementById('paper_amount').setAttribute('required', 'false');


            }
            monthlyInstallment()
            getInvoices()

        });
        $("#last_deposit").on("change", function (e) {
            last_deposit = e.target.value
            calculate_deposit()
        });

        $("#current_deposit").on("change", function (e) {
            current_deposit = e.target.value
            calculate_deposit()
        });
        $("#months_count").on("change", function (e) {
            months_count = e.target.value
            const division_type = $("#txt_division_type").val();
            if (division_type == 'manual') {
                generate_months_division();
            }
            monthlyInstallment()

        });
        $("#monthly_profit_percent").on("change", function (e) {
            monthly_profit_percent = e.target.value
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
            getInvoices()
        });
        $("#pay_day").on("change", function (e) {
            pay_day = e.target.value
            TransactionNumber()
        });


        /*                                  methods                                 */

        function TransactionNumber() {
            if (pay_day && customer) {
                $("#transaction_number").val(pay_day + '.' + customer);
            }
        }

        function remainingPrice() {

            if (total_price && deposit) {
                total_price = parseFloat(total_price)
                deposit = parseFloat(deposit)
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
                    monthlyInstallment()
                }
            }
        }

        function calculate_deposit() {
            if (last_deposit && current_deposit) {
                let calc_deposit = parseFloat(last_deposit) + parseFloat(current_deposit);
                $("#deposit").val(calc_deposit);
                deposit = calc_deposit;
                remainingPrice()
            }
        }

        function monthlyInstallment() {


            if (monthly_profit_percent && remaining_price && months_count) {

                let eq_percent = (monthly_profit_percent / 100) / 12;
                let eq_month_percent = eq_percent * months_count;
                let eq_additional_money = eq_month_percent * remaining_price
                let eq_total_money = eq_additional_money + remaining_price
                let eq_every_month = eq_total_money / months_count

                eq_every_month = eq_every_month.toFixed(2);
                monthly_installment = eq_every_month


                eq_additional_money = eq_additional_money.toFixed(2);
                eq_month_percent = eq_month_percent.toFixed(2);
                +
                    $("#profit").val(eq_additional_money);


                let remaining_price2 = $("#remaining_price").val();
                let profit2 = $("#profit").val();
                let installment_price = parseFloat(profit2) + parseFloat(remaining_price2);
                installment_price = installment_price.toFixed(2);
                $("#installment_price").val(installment_price);

                $("#monthly_installment").val(eq_every_month);
                $("#months_total_percentage").val(eq_month_percent);

                // نسبة الربح من الفاتورة
                let installment_price_2 = $("#installment_price").val();
                let up_value = parseFloat(installment_price_2) - parseFloat(remaining_price2)
                let profit_percentage = up_value / parseFloat(installment_price_2)
                profit_percentage = profit_percentage.toFixed(2);

                $("#profit_percentage").val(profit_percentage);
            }
        }

        function reverseMonthlyInstallment() {

            if (monthly_profit_percent && remaining_price && months_count) {


                let eq_every_month = months_count * monthly_installment
                let eq_total_money = eq_every_month - remaining_price
                let eq_additional_money = eq_total_money / remaining_price
                let eq_month_percent = eq_additional_money / months_count;
                let eq_percent = (eq_month_percent * 100) * 12;


                monthly_profit_percent = eq_percent.toFixed(2);

                if (monthly_profit_percent < 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'لا يكن ان يكون عدد الاشهر ' + monthly_installment,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'تم'
                    })

                    $("#monthly_installment").val(null);
                    $("#profit").val(null);
                } else {
                    $("#profit").val(eq_total_money);
                    $("#monthly_profit_percent").val(monthly_profit_percent);

                }

            }
        }

        function getInvoices() {
            // make ajax get request to get invoice of customer
            let customer_id = $('#customer_select').val()
            let invoice_type = $('#invoice_type').val()
            if (invoice_type == `{{\App\Enums\InvoiceTypeEnum::INVOICE->value}}`) {
                let url = "{{ route('invoice.getInvoice') }}";
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        customer_id: customer_id,
                    },
                    success: function (data) {

                        if (data.length > 0) {
                            let html = ''
                            data.forEach(element => {
                                html += `<option value="${element.id}">${element.invoice_number}</option>`
                            });
                            $('#customer_invoices').html(html)
                            $('#customer_invoices_group').removeClass('d-none')
                        } else {
                            swal.fire({
                                icon: 'error',
                                title: 'لا يوجد فواتير لهذا العميل',
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: 'تم'
                            })

                            // make selected invoice_type null
                            $('#invoice_type').val(null).trigger('change');


                            $('#customer_invoices').html('')
                            $('#customer_invoices_group').addClass('d-none')

                        }

                    },
                    error: function (data) {
                    }
                });
            }

        }


        $('#InvoiceSubmit').unbind('click').bind('click', function (event) {

            $('.errors').hide();
            event.preventDefault();
            var form = $('form#formInvoice')[0];
            var formData = new FormData(form);
            let route = '{{route('invoices.store')}}';
            $.ajax({
                url: route,
                type: 'POST',
                _method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#InvoiceSubmit").prop('disabled', true);
                },
                success: function (data) {
                    if (data.status == true) {
                        window.setTimeout(function () {
                            var id = data.id;
                            var url = "{{ route('invoices.installments', ':id') }}";
                            url = url.replace(':id', id);
                            window.location.href = url;
                        }, 50);

                    } else {
                        $("#InvoiceSubmit").prop('disabled', false);
                        Swal.fire({
                            icon: 'warning',
                            title: data.msg,
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'تم'
                        })
                        //close model
                        $('#postingInstallment' + id).modal('hide');
                    }


                },
                error: function (data) {

                    $("#InvoiceSubmit").prop('disabled', false);

                    if (data.status === 422) {
                        $('.errors').empty();
                        $.each(JSON.parse(data.responseText).errors, function (key, value) {
                            if (!key.search("dates")) {
                                var arr = key.split(".");
                                $('.errors').show();
                                $('.error_dates' + arr[1] + arr[2]).show();
                                $(document).find('.error_dates' + arr[1] + arr[2]).html(JSON.parse(data.responseText).errors[key]);
                            } else {
                                $('.errors').show();
                                $('.form_error_' + key).show();
                                $(document).find('.form_error_' + key).html(JSON.parse(data.responseText).errors[key]);
                            }
                        });
                    }
                }
            });
        });

    </script>

    <script>
        function remove_division() {
            $('#txt_division_type').val('dynamic');
            $('#division_container').hide();
        };
        $('#btn_months_division').click(function () {
            generate_months_division();

        });

        function generate_months_division() {
            var month_count = $("#months_count").val();
            var installment_amount = $("#installment_price").val();
            if (month_count && installment_amount) {
                $.ajax({
                    url: "/admin/get_month_division/" + month_count + "/" + installment_amount,
                    dataType: 'html',
                    type: 'get',
                    success: function (data) {

                        $('#txt_division_type').val('manual');
                        $('#division_container').show();
                        $('#manual_division_container').html(data);
                    }
                });
            }
        }

        function sum_division() {
            // Select all input elements with the class "installment_divided_class"
            const inputElements = document.querySelectorAll('.installment_divided_class');
            inputElements.forEach(function (input) {
                // Access each input element and its value
                if (input.value) {
                    total_amount = parseFloat(total_amount) + parseFloat(input.value);
                }
                // You can perform operations on each input element here
            });
            $("#total-price").html(total_amount);
            $("#total_sum_division_prices").val(total_amount);
            total_amount = 0;
        }

    </script>
@endpush
