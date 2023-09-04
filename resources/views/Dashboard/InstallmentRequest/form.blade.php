<div class="card-body row">
    <div class="form-group  col-lg-6 col-sm-6 ">
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

    <div class="form-group  col-lg-6 col-sm-6 ">
        <label>{{trans('lang.guarantor')}}</label>
        <div class="  {{ $errors->has('customers_ids') ? ' border  border-danger rounded' : '' }}">
            <select name="customers_ids[]"  id="kt_select2_2_modal"  multiple class="form-control select2">
                @foreach($customers as $key =>$row)
                    <option
                         @if(Request::segment(3)== 'installment_requests' && Request::segment(5)== 'edit')
                             {{ (collect($data->customers )->map(function ($q) { return $q->id; } )->contains($row->id)) ? 'selected':'' }}
                        @elseif( old('customers_ids'))
                            {{ (collect(old('customers_ids'))->contains($row->id)) ? 'selected':'' }}
                        @endif
                        value="{{ $row->id }}">{{ $row->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @if($errors->has('customers_ids'))
            <span class="text-danger m-2 ">{{ $errors->first('customers_ids') }}</span>
        @endif
    </div>

    <div class="form-group  col-lg-6 col-sm-6 ">
        <label>{{trans('lang.deposit')}}<span
                class="text-danger">*</span></label>
        <input name="deposit" placeholder="{{trans('lang.deposit')}}"
               value="{{ old('deposit', $data->deposit ?? '') }}"
               class="form-control  {{ $errors->has('deposit') ? 'border-danger' : '' }}" type="number"
               maxlength="255"/>

        @if($errors->has('deposit'))
            <span class="text-danger m-2 ">{{ $errors->first('deposit') }}</span>
        @endif
    </div>
    <div class="form-group  col-lg-6 col-sm-6 ">
        <label>{{trans('lang.price')}}<span
                class="text-danger">*</span></label>
        <input name="price" placeholder="{{trans('lang.price')}}"
               value="{{ old('price', $data->price ?? '') }}"
               class="form-control  {{ $errors->has('price') ? 'border-danger' : '' }}" type="number"
               maxlength="255"/>

        @if($errors->has('price'))
            <span class="text-danger m-2 ">{{ $errors->first('price') }}</span>
        @endif
    </div>

    <div class="form-group col-lg-6 col-sm-6">
        <label>{{trans('lang.product')}}</label>
        <textarea name="product" placeholder="{{trans('lang.product')}}"
                  class="form-control  {{ $errors->has('product') ? 'border-danger' : '' }}" type="text"
                  maxlength="255">{{ old('product', $data->product ?? '') }}</textarea>

        @if($errors->has('product'))
            <span class="text-danger m-2 ">{{ $errors->first('product') }}</span>
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
