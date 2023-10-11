<div class="card-body row">


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
        @if($errors->has('customer_id'))
            <span class="text-danger m-2 ">{{ $errors->first('customer_id') }}</span>
        @endif


    </div>


    <div id="customer_invoices_group" class="form-group   col-lg-4 col-sm-4  d-none">
        <label>{{trans('lang.old_invoice')}}</label>
        <div class="  {{ $errors->has('invoice_type') ? ' border  border-danger rounded' : '' }}">
            <select name="invoice_id"
                    class="form-control select2"
                    id="customer_invoices">
                <option selected disabled></option>

            </select>
        </div>
        @if($errors->has('invoice_id'))
            <span class="text-danger m-2 ">{{ $errors->first('invoice_id') }}</span>
        @endif


    </div>
    <div class="form-group   col-lg-4 col-sm-4  ">
        <label>{{trans('lang.amount')}}</label>
        <input name="amount" placeholder="{{trans('lang.amount')}}"
               value="{{ old('amount', $data->amount ?? '') }}"
               class="form-control  {{ $errors->has('amount') ? 'border-danger' : '' }}" type="number"
               maxlength="255"/>

    @if($errors->has('amount'))
        <span class="text-danger m-2 ">{{ $errors->first('amount') }}</span>
    @endif


</div>

</div>
<div class="card-footer text-left">
    <button type="Submit" id="submit" class="btn btn-primary btn-default ">{{trans('lang.save')}}</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">{{trans('lang.cancel')}}</a>
</div>

@push('scripts')

    <script !src="">

        $('#customer_select').select2({
            placeholder: `{{trans('lang.choose_the_customer')}}`,
            tags: true
        });

        $('#customer_invoices').select2({
            placeholder: `{{trans('lang.customer_invoices')}}`,
            width: '100%',
            tags: true
        });

        $("#customer_select").on("change", function (e) {
            customer = e.target.value
            getInvoices()
        });

        function getInvoices() {
            // make ajax get request to get invoice of customer
            let customer_id = $('#customer_select').val()
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
                    console.log(data)
                }
            });
        }
    </script>

@endpush
