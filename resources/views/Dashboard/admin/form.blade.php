<div class="card-body row">
    <div class="form-group  col-sm-4">
        <label>{{trans('lang.name')}}<span
                class="text-danger">*</span></label>
        <input name="name" placeholder="{{trans('lang.name')}}"  value="{{ old('name', $data->name ?? '') }}" class="form-control  {{ $errors->has('name') ? 'border-danger' : '' }}" type="text"
               maxlength="255" />

        @if($errors->has('name'))
            <span  class="text-danger m-2 ">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group  col-sm-4">
        <label>{{trans('lang.email')}}<span
                class="text-danger">*</span></label>
        <input name="email" placeholder="{{trans('lang.name')}}"  value="{{ old('email', $data->email ?? '') }}" class="form-control  {{ $errors->has('email') ? 'border-danger' : '' }}" type="email"
               maxlength="255" />

        @if($errors->has('email'))
            <span  class="text-danger m-2 ">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group  col-sm-4">
        <label>{{trans('lang.phone')}}<span
                class="text-danger">*</span></label>
        <input name="phone" placeholder="{{trans('lang.phone')}}"  value="{{ old('phone', $data->phone ?? '') }}" class="form-control  {{ $errors->has('phone') ? 'border-danger' : '' }}" type="number"
               maxlength="255" />

        @if($errors->has('phone'))
            <span  class="text-danger m-2 ">{{ $errors->first('phone') }}</span>
        @endif
    </div>
    <div class="form-group  col-sm-4">
        <label>{{trans('lang.password')}}
            @if(request()->segment(2) == 'create') <span class="text-danger">*</span>@endif
        </label>
        <input name="password" placeholder="{{trans('lang.password')}}"  value="{{ old('password') }}" class="form-control  {{ $errors->has('password') ? 'border-danger' : '' }}" type="password"
               maxlength="255" />

        @if($errors->has('password'))
            <span  class="text-danger m-2 ">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group  col-sm-4">
        <label>{{trans('lang.password_confirmation')}}
            @if(request()->segment(2) == 'create') <span class="text-danger">*</span> @endif
        </label>
        <input name="password_confirmation" placeholder="{{trans('lang.password_confirmation')}}"  value="{{ old('password_confirmation') }}" class="form-control  {{ $errors->has('password_confirmation') ? 'border-danger' : '' }}" type="password"
               maxlength="255" />
    </div>
    <div class="form-group col-sm-4">
        <label class="d-block">{{trans('lang.role')}}</label>

        <select name="role_id"   class="form-control select2 {{ $errors->has('role_id') ? 'border-danger' : '' }}" id="kt_select2_1_modal">
            @foreach($roles as $row)
                <option selected disabled ></option>
                <option
                    @if(Request::segment(3)== 'admins' && Request::segment(4)== 'edit')
                    {{ $row->id == old('role_id',  $data->role_id)  ? 'selected' : '' }}
                    @else
                    {{ $row->id == old('role_id') ? 'selected' : '' }}
                    @endif
                    value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>

        @if($errors->has('role_id'))
            <span  class="text-danger m-2 ">{{ $errors->first('role_id') }}</span>
        @endif
    </div>
    <div class="form-group col-sm-4">
        <label for="">{{trans('lang.image')}}</label>
        <div class="col-lg-12">
            <div class="image-input image-input-outline" id="kt_image_1">
                <div class="image-input-wrapper {{ $errors->has('image') ? 'border-danger' : '' }}"
                     style="background-image: url({{asset('/')}}{{ $data->image ?? 'defaults/default_image.png'}})"></div>
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
