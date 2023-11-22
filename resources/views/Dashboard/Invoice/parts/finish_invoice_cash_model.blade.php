<div class="modal fade" id="finish_invoice_cash_model" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> انهاء الفاتورة كاش</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="post" id="finish_cash_form" action="javascript:void(0)" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$invoice->id}}" name="id" required>
                <div class="modal-body row">
                    <div class="row">

                        <div class="form-group  col-4">
                            <label>نسبة الخصم %<span class="text-danger">*</span></label>
                            <input name="discount_percentage" id="discount_percentage"
                                   value="{{ old('discount_percentage', settings('discount_percentage') ) }}"
                                   class="form-control  {{ $errors->has('discount_percentage') ? 'border-danger' : '' }}"
                                   type="number" min="0" step="any"
                                   max="100"
                            />
                            <span class="text-danger errors form_error_discount_percentage" role="alert"></span>
                        </div>
                        <div class="form-group  col-4">
                            <label>عدد اشهر الخصم<span
                                    class="text-danger">*</span></label>
                            <input name="discount_month" id="discount_month"
                                   value="{{ old('discount_month', $invoice->remain_installments->count()) }}"
                                   class="form-control  {{ $errors->has('discount_month') ? 'border-danger' : '' }}"
                                   type="number" min="1"
                            />
                            <span class="text-danger errors form_error_discount_month" role="alert"></span>
                        </div>
                        <div class="form-group  col-4">
                            <label>السعر المتبقي<span
                                    class="text-danger">*</span></label>
                            <input name="discount_remain_installments" id="discount_remain_installments" readonly
                                   value="{{ old('discount_remain_installments', $invoice->remain_installments_price) }}"
                                   class="form-control form-control-solid {{ $errors->has('discount_remain_installments') ? 'border-danger' : '' }}"
                                   type="number" min="0"
                            />
                            <span class="text-danger errors form_error_discount_remain_installments"
                                  role="alert"></span>
                        </div>
                        <div class="form-group  col-4">
                            <label>قيمة الخصم<span
                                    class="text-danger">*</span></label>
                            <input name="discount_value" id="discount_value"
                                   value="{{ old('discount_value', $data->discount_value ?? '') }}"
                                   class="form-control  {{ $errors->has('discount_value') ? 'border-danger' : '' }}"
                                   type="number"
                            />
                            <span class="text-danger errors form_error_discount_value" role="alert"></span>
                        </div>
                        <div class="form-group  col-8">
                            <label>المبلغ المراد تحصيلة من العميل<span
                                    class="text-danger">*</span></label>
                            <input name="discount_money_collected" id="discount_money_collected" readonly
                                   value="{{ old('discount_money_collected', $data->discount_money_collected ?? '') }}"
                                   class="form-control form-control-solid  {{ $errors->has('discount_money_collected') ? 'border-danger' : '' }}"
                                   type="number"
                            />
                            <span class="text-danger errors form_error_discount_money_collected" role="alert"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="testTest" class="btn btn-light-primary font-weight-bold "
                            data-dismiss="modal">@lang('lang.cancel')</button>
                    <button type="submit" class="btn btn-primary font-weight-bold" id="finish_invoice_submit">انهاء الفاتورة
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')

    <script>
        let discount_percentage = null;
        let discount_month = null;
        let discount_remain_installments = null;
        let discount_value = null;
        $(document).ready(function () {
            discount_month = $('#discount_month').val();
            calculate_discount();
        });

        $("#discount_percentage").on("keyup", function (e) {
            discount_percentage = e.target.value
            calculate_discount();
        });

        $("#discount_month").on("keyup", function (e) {
            discount_month = e.target.value
            calculate_discount();
        });

        $("#discount_value").on("keyup", function (e) {
            discount_value = e.target.value
            // calculate_discount();

            discount_percentage = $('#discount_percentage').val();

            discount_remain_installments = $('#discount_remain_installments').val();

            // const first_calc = discount_percentage / 100;
            const second_calc = discount_percentage * discount_month;
            const third_calc = second_calc * discount_remain_installments;
            const fourth_calc = discount_value;
            const fifth_calc = discount_remain_installments - fourth_calc;
            // $('#discount_percentage').val(fourth_calc);

            $('#discount_money_collected').val(fifth_calc);
        });


        function calculate_discount() {
            discount_percentage = $('#discount_percentage').val();
            discount_month = $('#discount_month').val();
            discount_remain_installments = $('#discount_remain_installments').val();

            // const first_calc = discount_percentage / 100;
            const second_calc = discount_percentage * discount_month;
            const third_calc = second_calc * discount_remain_installments;
            const fourth_calc = third_calc / 100;
            $('#discount_value').val(fourth_calc);
            const fifth_calc = discount_remain_installments - fourth_calc;

            $('#discount_money_collected').val(fifth_calc);
        }

        $('#finish_invoice_submit').unbind('click').bind('click', function (event) {

            $('.errors').hide();
            event.preventDefault();
            var form = $('form#finish_cash_form')[0];
            var formData = new FormData(form);
            let route = '{{route('invoices.finish_cash')}}';
            $.ajax({
                url: route,
                type: 'POST',
                _method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#finish_invoice_submit").prop('disabled', true);
                },
                success: function (data) {
                    if (data.status == true) {
                        Swal.fire({
                            icon: 'success',
                            title: data.msg,
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'تم'
                        })
                        window.setTimeout(function () {
                            var url = "{{ route('invoices.index') }}";
                            window.location.href = url;
                        }, 50);
                    } else {
                        $("#finish_invoice_submit").prop('disabled', false);
                        Swal.fire({
                            icon: 'warning',
                            title: data.msg,
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'تم'
                        })
                    }
                },
                error: function (data) {

                    $("#finish_invoice_submit").prop('disabled', false);

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
@endpush
