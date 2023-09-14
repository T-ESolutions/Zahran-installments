<div class="row text-capitalize">
    <div class="col-sm-6">
        <div class="form-group ">
            <label for="site_name_ar">{{trans('lang.website_name_ar')}}<span
                    class="text-danger">*</span></label>
            <input type="text" name="site_name_ar" id="site_name_ar"
                   value="{{ old('site_name_ar', $data->where('key', 'site_name_ar')->first()->val) }}"
                   class="form-control {{ $errors->has('site_name_ar') ? 'border-danger' : '' }}"
                   placeholder=""/>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group ">
            <label for="site_name_en">{{trans('lang.website_name_en')}}<span
                    class="text-danger">*</span></label>
            <input type="text" name="site_name_en" id="site_name_en"
                   value="{{ old('site_name_en', $data->where('key', 'site_name_en')->first()->val) }}"
                   class="form-control {{ $errors->has('site_name_en') ? 'border-danger' : '' }}"
                   placeholder=""/>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group ">
            <label for="copyright">{{trans('lang.copyrights')}}<span class="text-danger">*</span></label>
            <input type="text" name="copyright" id="location"
                   value="{{ old('copyright', $data->where('key', 'copyright')->first()->val) }}"
                   class="form-control {{ $errors->has('copyright') ? 'border-danger' : '' }}"
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
</div>


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
