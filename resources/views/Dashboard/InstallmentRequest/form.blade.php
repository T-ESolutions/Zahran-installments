<div class="card-body row">

    <div class="form-group  col-4">
        <label>{{trans('lang.name_ar')}}<span
                class="text-danger">*</span></label>
        <input name="name_ar" placeholder="{{trans('lang.name_ar')}}"  value="{{ old('name_ar', $data->name_ar ?? '') }}" class="form-control  {{ $errors->has('name_ar') ? 'border-danger' : '' }}" type="text"
               maxlength="255" />

        @if($errors->has('name_ar'))
            <span  class="text-danger m-2 ">{{ $errors->first('name_ar') }}</span>
        @endif
    </div>




    <div class="col-4">
        <label for="">{{trans('lang.image')}}<span
                class="text-danger">*</span></label>
        <div class="col-lg-8">
            <div class="image-input image-input-outline" id="kt_image_1">
                <div class="image-input-wrapper {{ $errors->has('image') ? 'border-danger' : '' }}"
                     style="background-image: url( {{asset('/')}}{{ $data->image ?? ''}})"></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                       data-action="change" data-toggle="tooltip" title=""
                       data-original-title="اختر صوره">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" value="{{ old('image', @url('/').@$data->image ??'') }}"
                           name="image" accept=".png, .jpg, .jpeg"/>
                  </label>
            </div>
        </div>
        @if($errors->has('image'))
            <span class="text-danger m-2 ">{{ $errors->first('image') }}</span>
        @endif


    </div>



</div>
<div class="card-footer text-left">
    <button type="Submit" id="submit" class="btn btn-primary btn-default ">{{trans('lang.save')}}</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">{{trans('lang.cancel')}}</a>
</div>

@push('scripts')


    <script !src="">
        var avatar1 = new KTImageInput('kt_image_1');
    </script>

@endpush
