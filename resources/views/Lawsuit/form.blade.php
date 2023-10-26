<div class="card-body ">
    <div class="row">
        <div class="form-group">
            <label>النوع</label>
            <div class="radio-inline">
                <label class="radio">
                    <input type="radio" checked="checked" name="type" value="1">
                    <span></span>انذار</label>
                <label class="radio">
                    <input type="radio" name="type" value="2">
                    <span></span>قضية</label>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="form-group  col-lg-4 col-sm-4 ">
            <label>{{trans('lang.the_customer')}}<span class="text-danger">*</span></label>
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
            <label>رقم فاتورة الشراء<span class="text-danger">*</span></label>
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
            <label>{{trans('lang.amount')}}<span class="text-danger">*</span></label>
            <input name="amount" placeholder="{{trans('lang.amount')}}"
                   value="{{ old('amount', $data->amount ?? '') }}"
                   class="form-control  {{ $errors->has('amount') ? 'border-danger' : '' }}" type="number"
                   min="0" step="any"/>

            @if($errors->has('amount'))
                <span class="text-danger m-2 ">{{ $errors->first('amount') }}</span>
            @endif


        </div>
    </div>
    <div class="row">
        <div class="form-group  col-4">
            <label>عنوان المصروف<span class="text-danger">*</span></label>
            <input name="title" value="{{ old('title', $data->title ?? '') }}" required
                   class="form-control  {{ $errors->has('title') ? 'border-danger' : '' }}" type="text"
                   maxlength="191"/>

            @if($errors->has('title'))
                <span class="text-danger m-2 ">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group  col-8">
            <label>الوصف</label>
            <textarea name="description" rows="3"
                      class="form-control  {{ $errors->has('description') ? 'border-danger' : '' }}"
            >{{ old('description', $data->description ?? '') }}</textarea>

            @if($errors->has('description'))
                <span class="text-danger m-2 ">{{ $errors->first('description') }}</span>
            @endif
        </div>
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
