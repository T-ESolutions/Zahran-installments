<div class=" text-capitalize">
    <div class="row">
    <div class="col-sm-12">
        <div class="form-group ">
            <label for="site_name_ar">اسم الموقع<span
                    class="text-danger">*</span></label>
            <input type="text" name="site_name_ar" id="site_name_ar"
                   value="{{ old('site_name_ar', $data->where('key', 'site_name_ar')->first()->val) }}"
                   class="form-control {{ $errors->has('site_name_ar') ? 'border-danger' : '' }}"
                   placeholder=""/>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group ">
            <label for="copyright">{{trans('lang.monthly_profit_percent')}}<span class="text-danger">*</span></label>
            <input type="number" name="monthly_profit_percent" id="location"
                   value="{{ old('monthly_profit_percent', $data->where('key', 'monthly_profit_percent')->first()->val) }}"
                   class="form-control {{ $errors->has('monthly_profit_percent') ? 'border-danger' : '' }}"
                   placeholder=""/>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group ">
            <label for="site_name_en">{{trans('lang.discount_percentage')}}<span
                    class="text-danger">*</span></label>
            <input type="text" name="discount_percentage" id="discount_percentage"
                   value="{{ old('discount_percentage', $data->where('key', 'discount_percentage')->first()->val) }}"
                   class="form-control {{ $errors->has('discount_percentage') ? 'border-danger' : '' }}"
                   placeholder=""/>
        </div>
    </div>
    </div>
    <h3 class="text-primary">اعدادات وصل الامانة</h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group ">
                <label for="site_name_en">{{trans('lang.first_name')}}<span
                        class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name"
                       value="{{ old('first_name', $data->where('key', 'first_name')->first()->val) }}"
                       class="form-control {{ $errors->has('first_name') ? 'border-danger' : '' }}"
                       placeholder=""/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group ">
                <label for="site_name_en">{{trans('lang.second_name')}}<span
                        class="text-danger">*</span></label>
                <input type="text" name="second_name" id="second_name"
                       value="{{ old('second_name', $data->where('key', 'second_name')->first()->val) }}"
                       class="form-control {{ $errors->has('second_name') ? 'border-danger' : '' }}"
                       placeholder=""/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group ">
                <label for="site_name_en">{{trans('lang.third_name')}}<span
                        class="text-danger">*</span></label>
                <input type="text" name="third_name" id="third_name"
                       value="{{ old('third_name', $data->where('key', 'third_name')->first()->val) }}"
                       class="form-control {{ $errors->has('third_name') ? 'border-danger' : '' }}"
                       placeholder=""/>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group ">
                <label for="site_name_en">{{trans('lang.fourth_name')}}<span
                        class="text-danger">*</span></label>
                <input type="text" name="fourth_name" id="fourth_name"
                       value="{{ old('fourth_name', $data->where('key', 'fourth_name')->first()->val) }}"
                       class="form-control {{ $errors->has('fourth_name') ? 'border-danger' : '' }}"
                       placeholder=""/>
            </div>
        </div>
    </div>
</div>

<h3 class="text-primary">اعدادات الشعار</h3>

<div class="row text-capitalize">
    <div class="col-3">
        <label for="">{{trans('lang.website_logo')}}<span
                class="text-danger">*</span></label>
        <div class="col-lg-8">
            <div class="image-input image-input-outline" id="kt_image_1">
                <div class="image-input-wrapper {{ $errors->has('logo') ? 'border-danger' : '' }}"
                     style="background-image: url({{$data->where('key', 'logo')->first()->val ?? ''}})"></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                       data-action="change" data-toggle="tooltip" title=""
                       data-original-title="اختر صوره">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" value="{{ old('youtube', $data->where('key', 'logo')->first()->val) }}"
                           name="logo" accept=".png, .jpg, .jpeg"/>
                </label>
 </span>
            </div>
        </div>
    </div>
    <div class="col-3">
        <label for="">{{trans('lang.url_logo')}}<span
                class="text-danger">*</span></label>
        <div class="col-lg-8">
            <div class="image-input image-input-outline" id="kt_image_3">
                <div class="image-input-wrapper {{ $errors->has('logo_login') ? 'border-danger' : '' }}"
                     style="background-image: url({{$data->where('key', 'logo_login')->first()->val ?? ''}})"></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                       data-action="change" data-toggle="tooltip" title=""
                       data-original-title="اختر صوره">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" value="{{ old('logo_login', $data->where('key', 'logo_login')->first()->val) }}"
                           name="logo_login"
                           accept=".png, .jpg, .jpeg"/>
                </label>
{{--                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"--}}
{{--                      data-action="cancel" data-toggle="tooltip" title="Cancel avatar">--}}
{{--  <i class="ki ki-bold-close icon-xs text-muted"></i>--}}
 </span>
            </div>
        </div>
    </div>
</div>
<br>
<br>
@can('update-settings')
    <div class="card-footer text-left">
        <button type="Submit" id="submit" class="btn btn-primary btn-default ">{{trans('lang.save')}}</button>
        <a href="{{ URL::previous() }}" class="btn btn-secondary">{{trans('lang.cancel')}}</a>
    </div>
@endcan
