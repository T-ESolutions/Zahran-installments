<div class="card-body row">
    <div class="row col-9">
        <div class="form-group  col-4">
            <label>{{trans('lang.name')}}<span
                    class="text-danger">*</span></label>
            <input name="name" placeholder="{{trans('lang.name')}}" value="{{ old('name', $data->name ?? '') }}"
                   class="form-control  {{ $errors->has('name') ? 'border-danger' : '' }}" type="text"
                   maxlength="255"/>

            @if($errors->has('name'))
                <span class="text-danger m-2 ">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group  col-4">
            <label>{{trans('lang.id_number')}}<span
                    class="text-danger">*</span></label>
            <input name="id_number" placeholder="{{trans('lang.id_number')}}"
                   value="{{ old('id_number', $data->id_number ?? '') }}"
                   class="form-control  {{ $errors->has('id_number') ? 'border-danger' : '' }}" type="number"
                   maxlength="255"/>

            @if($errors->has('id_number'))
                <span class="text-danger m-2 ">{{ $errors->first('id_number') }}</span>
            @endif
        </div>
        <div class="form-group  col-4">
            <label>{{trans('lang.address_id')}}<span
                    class="text-danger">*</span></label>
            <input name="address_id" placeholder="{{trans('lang.address_id')}}"
                   value="{{ old('address_id', $data->address_id ?? '') }}"
                   class="form-control  {{ $errors->has('address_id') ? 'border-danger' : '' }}" type="text"
                   maxlength="255"/>

            @if($errors->has('address_id'))
                <span class="text-danger m-2 ">{{ $errors->first('address_id') }}</span>
            @endif
        </div>
        <div class="form-group  col-4">
            <label>{{trans('lang.phone')}}<span
                    class="text-danger">*</span></label>
            <input name="phone" placeholder="{{trans('lang.phone')}}"
                   value="{{ old('phone', $data->phone ?? '') }}"
                   class="form-control  {{ $errors->has('phone') ? 'border-danger' : '' }}" type="number"
                   maxlength="255"/>

            @if($errors->has('phone'))
                <span class="text-danger m-2 ">{{ $errors->first('phone') }}</span>
            @endif
        </div>
        <div class="form-group  col-4">
            <label>{{trans('lang.phone2')}}</label>
            <input name="phone2" placeholder="{{trans('lang.phone2')}}"
                   value="{{ old('phone2', $data->phone2 ?? '') }}"
                   class="form-control  {{ $errors->has('phone2') ? 'border-danger' : '' }}" type="number"
                   maxlength="255"/>

            @if($errors->has('phone2'))
                <span class="text-danger m-2 ">{{ $errors->first('phone2') }}</span>
            @endif
        </div>
        <div class="form-group  col-4">
            <label>{{trans('lang.phone3')}}</label>
            <input name="phone3" placeholder="{{trans('lang.phone3')}}"
                   value="{{ old('phone3', $data->phone3 ?? '') }}"
                   class="form-control  {{ $errors->has('phone3') ? 'border-danger' : '' }}" type="number"
                   maxlength="255"/>

            @if($errors->has('phone3'))
                <span class="text-danger m-2 ">{{ $errors->first('phone3') }}</span>
            @endif
        </div>
        <div class="form-group  col-4">
            <label>{{trans('lang.address')}}</label>
            <input name="address" placeholder="{{trans('lang.address')}}"
                   value="{{ old('address', $data->address ?? '') }}"
                   class="form-control  {{ $errors->has('address') ? 'border-danger' : '' }}" type="text"
                   maxlength="255"/>

            @if($errors->has('address'))
                <span class="text-danger m-2 ">{{ $errors->first('address') }}</span>
            @endif
        </div>
        <div class="form-group  col-4">
            <label>{{trans('lang.governorate')}}</label><span
                    class="text-danger">*</span>
            <input name="governorate" placeholder="{{trans('lang.governorate')}}"
                   value="{{ old('governorate', $data->governorate ?? '') }}"
                   class="form-control  {{ $errors->has('governorate') ? 'border-danger' : '' }}" type="text"
                   maxlength="255"/>

            @if($errors->has('governorate'))
                <span class="text-danger m-2 ">{{ $errors->first('governorate') }}</span>
            @endif
        </div>
        <div class="form-group  col-4">
            <label>{{trans('lang.center')}}</label><span
                    class="text-danger">*</span>
            <input name="center" placeholder="{{trans('lang.center')}}"
                   value="{{ old('center', $data->center ?? '') }}"
                   class="form-control  {{ $errors->has('center') ? 'border-danger' : '' }}" type="text"
                   maxlength="255"/>

            @if($errors->has('center'))
                <span class="text-danger m-2 ">{{ $errors->first('center') }}</span>
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
    </div>
    <div class="row col-3 border-left m-1" >
        <div class="col-6">
            <label for="">{{trans('lang.id_image')}}</label>
            <div class="col-lg-8">
                <div class="image-input image-input-outline" id="id_image">
                    <div class="image-input-wrapper {{ $errors->has('id_image') ? 'border-danger' : '' }}"
                         style="background-image: url( {{asset('/')}}{{ $data->id_image ?? ''}})"></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                           data-action="change" data-toggle="tooltip" title=""
                           data-original-title="اختر صوره">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" value="{{ old('image', @url('/').@$data->id_image ??'') }}"
                               name="id_image" accept=".png, .jpg, .jpeg"/>
                    </label>
                </div>
            </div>
            @if($errors->has('id_image'))
                <span class="text-danger m-2 ">{{ $errors->first('id_image') }}</span>
            @endif
        </div>
     </div>

    <div class="col-12 border-top " >
        <div id="kt_repeater_1">
            <div class="form-group row">
                <label class="col-lg-2 col-form-label text-right">@lang('lang.relatives') :</label>


                 @if(old('relatives') || (isset($data->relatives) && $data->relatives))
                     @foreach($data->relatives ?? old('relatives') as $relatives)
                        <div data-repeater-list="relatives" class="col-lg-12">
                            <div data-repeater-item="" class="form-group row align-items-center">

                                <div class="col-md-3">
                                    <label>@lang('lang.name')</label>
                                    <input type="text" value="{{ $relatives['name'] }}"  name= "name"  class="form-control" placeholder="@lang('lang.name')" />
                                    <div class="d-md-none mb-2"></div>
                                </div>


                                <div class="col-md-3">
                                    <label>@lang('lang.phone')</label>
                                    <input type="tel" name= "phone" value="{{ $relatives['phone'] }}" class="form-control" placeholder="@lang('lang.phone')" />
                                    <div class="d-md-none mb-2"></div>
                                </div>


                                <div class="col-md-3">
                                    <label>@lang('lang.note')</label>
                                    <textarea name="note" placeholder="{{trans('lang.note')}}"
                                              class="form-control" type="text"
                                              maxlength="255">value="{{ $relatives['note'] }}"</textarea>
                                    <div class="d-md-none mb-2"></div>
                                </div>

                                <div class="col-lg-1 col-md-1">
                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                        <i class="la la-trash-o"></i>{{trans('lang.delete')}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div data-repeater-list="relatives" class="col-lg-12">
                        <div data-repeater-item="" class="form-group row align-items-center">

                            <div class="col-md-3">
                                <label>@lang('lang.name')</label>
                                <input type="text"  name= "name"  class="form-control" placeholder="@lang('lang.name')" />
                                <div class="d-md-none mb-2"></div>
                            </div>


                            <div class="col-md-3">
                                <label>@lang('lang.phone')</label>
                                <input type="tel" name= "phone" class="form-control" placeholder="@lang('lang.phone')" />
                                <div class="d-md-none mb-2"></div>
                            </div>


                            <div class="col-md-3">
                                <label>@lang('lang.note')</label>
                                <textarea name="note" placeholder="{{trans('lang.note')}}"
                                          class="form-control" type="text"
                                          maxlength="255"></textarea>
                                <div class="d-md-none mb-2"></div>
                            </div>

                            <div class="col-lg-1 col-md-1">
                                <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                    <i class="la la-trash-o"></i>{{trans('lang.delete')}}</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group row">
                 <div class="col-lg-2">
                    <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                        <i class="la la-plus"></i>@lang('lang.add')</a>
                </div>
            </div>
        </div>
    </div>



    @if($errors->has('relatives'))
        <span class="text-danger m-2 ">{{ $errors->first('relatives') }}</span>
    @endif
</div>
<div class="card-footer text-left">
    <button type="Submit" id="submit" class="btn btn-primary btn-default ">{{trans('lang.save')}}</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">{{trans('lang.cancel')}}</a>
</div>

@push('scripts')

    <script !src="">
        var avatar1 = new KTImageInput('id_image');
        var KTFormRepeater = function () {

            // Private functions
            var demo1 = function () {
                $('#kt_repeater_1').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function () {
                        $(this).slideDown();
                    },

                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });
            }

            return {

                init: function () {
                    demo1();
                }
            };
        }();

        jQuery(document).ready(function () {
            KTFormRepeater.init();
        });
    </script>

@endpush
