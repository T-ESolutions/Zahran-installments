<div class="card-body row">

    <div class="form-group  col-4">
        <label>{{trans('lang.invoice_number')}}</label>
        <input name="invoice_number" placeholder="{{trans('lang.invoice_number')}}"  value="{{ old('invoice_number', $data->invoice_number ?? '') }}" class="form-control  {{ $errors->has('invoice_number') ? 'border-danger' : '' }}" type="text"
               maxlength="255" />

        @if($errors->has('invoice_number'))
            <span  class="text-danger m-2 ">{{ $errors->first('invoice_number') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.transaction_number')}}</label>
        <input name="transaction_number" disabled placeholder="{{trans('lang.transaction_number')}}"  value="{{ old('transaction_number', $data->transaction_number ?? '') }}" class="form-control  {{ $errors->has('transaction_number') ? 'border-danger' : '' }}" type="text"
               maxlength="255" />

        @if($errors->has('transaction_number'))
            <span  class="text-danger m-2 ">{{ $errors->first('transaction_number') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.pay_day')}}<span
                class="text-danger">*</span></label>
        <input name="pay_day" placeholder="{{trans('lang.pay_day')}}"  value="{{ old('pay_day', $data->pay_day ?? '') }}" class="form-control  {{ $errors->has('pay_day') ? 'border-danger' : '' }}" type="text"
               maxlength="255" />

        @if($errors->has('pay_day'))
            <span  class="text-danger m-2 ">{{ $errors->first('pay_day') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.invoice_date')}}<span
                class="text-danger">*</span></label>
        <input name="invoice_date" placeholder="{{trans('lang.invoice_date')}}"  value="{{ old('invoice_date', $data->invoice_date ?? '') }}" class="form-control  {{ $errors->has('invoice_date') ? 'border-danger' : '' }}" type="date"
               maxlength="255" />

        @if($errors->has('invoice_date'))
            <span  class="text-danger m-2 ">{{ $errors->first('invoice_date') }}</span>
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

    <div class="form-group  col-4">
        <label>{{trans('lang.product')}}</label>
        <textarea name="product" placeholder="{{trans('lang.product')}}"
                  class="form-control  {{ $errors->has('product') ? 'border-danger' : '' }}" type="text"
                  maxlength="255">{{ old('product', $data->product ?? '') }}</textarea>

        @if($errors->has('product'))
            <span class="text-danger m-2 ">{{ $errors->first('product') }}</span>
        @endif
    </div>

    <div class="form-group  col-lg-4 col-sm-4 ">
        <label>{{trans('lang.customers')}}</label>
        <div class="  {{ $errors->has('customer_id') ? ' border  border-danger rounded' : '' }}">
            <select name="customer_id"
                    class="form-control select2"
                    id="customer_select">
                <option selected disabled></option>
                @foreach($customers as $row)
                    <option
                        @if(Request::segment(3)== 'installment_requests' && Request::segment(5)== 'edit')
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
        <label>{{trans('lang.total_price')}}<span
                class="text-danger">*</span></label>
        <input name="total_price" placeholder="{{trans('lang.total_price')}}"  value="{{ old('total_price', $data->total_price ?? '') }}" class="form-control  {{ $errors->has('total_price') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255" />

        @if($errors->has('total_price'))
            <span  class="text-danger m-2 ">{{ $errors->first('total_price') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.deposit')}}<span
                class="text-danger">*</span></label>
        <input name="deposit" placeholder="{{trans('lang.deposit')}}"  value="{{ old('deposit', $data->deposit ?? '') }}" class="form-control  {{ $errors->has('deposit') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255" />

        @if($errors->has('deposit'))
            <span  class="text-danger m-2 ">{{ $errors->first('deposit') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.remaining_price')}}<span
                class="text-danger">*</span></label>
        <input name="remaining_price" placeholder="{{trans('lang.remaining_price')}}"  value="{{ old('remaining_price', $data->remaining_price ?? '') }}" class="form-control  {{ $errors->has('remaining_price') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255" />

        @if($errors->has('remaining_price'))
            <span  class="text-danger m-2 ">{{ $errors->first('remaining_price') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.monthly_profit_percent')}}<span
                class="text-danger">*</span></label>
        <input name="monthly_profit_percent" placeholder="{{trans('lang.monthly_profit_percent')}}"  value="{{ old('monthly_profit_percent', $data->monthly_profit_percent ?? $monthly_profit_percent ??   '' ) }}" class="form-control  {{ $errors->has('monthly_profit_percent') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255" />

        @if($errors->has('monthly_profit_percent'))
            <span  class="text-danger m-2 ">{{ $errors->first('monthly_profit_percent') }}</span>
        @endif
    </div>


    <div class="form-group  col-4">
        <label>{{trans('lang.monthly_count')}}<span
                class="text-danger">*</span></label>
        <input name="monthly_count" placeholder="{{trans('lang.monthly_count')}}"  value="{{ old('monthly_count', $data->monthly_count ?? '') }}" class="form-control  {{ $errors->has('monthly_count') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255" />

        @if($errors->has('monthly_count'))
            <span  class="text-danger m-2 ">{{ $errors->first('monthly_count') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.monthly_pay')}}<span
                class="text-danger">*</span></label>
        <input name="monthly_pay" placeholder="{{trans('lang.monthly_pay')}}"  value="{{ old('monthly_pay', $data->monthly_pay ?? '') }}" class="form-control  {{ $errors->has('monthly_pay') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255" />

        @if($errors->has('monthly_pay'))
            <span  class="text-danger m-2 ">{{ $errors->first('monthly_pay') }}</span>
        @endif
    </div>

    <div class="form-group  col-4">
        <label>{{trans('lang.profit')}}<span
                class="text-danger">*</span></label>
        <input name="profit" placeholder="{{trans('lang.profit')}}"  value="{{ old('profit', $data->profit ?? '') }}" class="form-control  {{ $errors->has('profit') ? 'border-danger' : '' }}"
               type="number"
               step="0.01"
               maxlength="255" />

        @if($errors->has('profit'))
            <span  class="text-danger m-2 ">{{ $errors->first('profit') }}</span>
        @endif
    </div>

</div>
<div class="card-footer text-left">
    <button type="Submit" id="submit" class="btn btn-primary btn-default ">{{trans('lang.save')}}</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">{{trans('lang.cancel')}}</a>
</div>

@push('scripts')


    <script !src="">
        $('#kt_select2_2_modal').select2({
            placeholder: `{{trans('lang.guarantor')}}`,
            tags: true
        });
        $('#customer_select').select2({
            placeholder: `{{trans('lang.customers')}}`,
            tags: true
        });
        var avatar1 = new KTImageInput('kt_image_1');
    </script>

@endpush
