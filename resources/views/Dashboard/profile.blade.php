@php($title=trans('lang.update_profile'))
@extends('adminLayouts.app')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Breadcrumb-->
        <h5 class="text-primary  font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"
                   class="text-muted">{{trans('lang.dashboard')}}</a>
            </li>


        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

        <div class="card">
            <div class="card-body">
                <form method="post"  action="{{route('update_profile_post')}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="card-body row">
                        <input hidden="" name="id" value="{{auth()->user()->id}}" >

                        <div class="form-group  col-4">
                            <label>{{trans('lang.name')}}<span
                                    class="text-danger">*</span></label>
                            <input name="name" placeholder="{{trans('lang.name')}}"  value="{{ old('name', auth()->user()->name ?? '') }}" class="form-control  {{ $errors->has('name') ? 'border-danger' : '' }}" type="text"
                                   maxlength="255" />

                            @if($errors->has('name'))
                                <span  class="text-danger m-2 ">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group  col-4">
                            <label>{{trans('lang.email')}}<span
                                    class="text-danger">*</span></label>
                            <input name="email" placeholder="{{trans('lang.email')}}"  value="{{ old('email', auth()->user()->email ?? '') }}" class="form-control  {{ $errors->has('email') ? 'border-danger' : '' }}" type="text"
                                   maxlength="255" />

                            @if($errors->has('email'))
                                <span  class="text-danger m-2 ">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group  col-4">
                            <label>{{trans('lang.phone')}}<span
                                    class="text-danger">*</span></label>
                            <input name="phone" placeholder="{{trans('lang.phone')}}"  value="{{ old('phone', auth()->user()->phone ?? '') }}" class="form-control  {{ $errors->has('phone') ? 'border-danger' : '' }}" type="tel"
                                   maxlength="255" />

                            @if($errors->has('phone'))
                                <span  class="text-danger m-2 ">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group  col-6">
                            <label>{{trans('lang.password')}}<span
                                    class="text-danger">*</span></label>
                            <input name="password" placeholder="{{trans('lang.password')}}"  value="" class="form-control  {{ $errors->has('password') ? 'border-danger' : '' }}" type="password"
                                   maxlength="255" />

                            @if($errors->has('password'))
                                <span  class="text-danger m-2 ">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group  col-6">
                            <label>{{trans('lang.password_confirmation')}}<span
                                    class="text-danger">*</span></label>
                            <input name="password_confirmation" placeholder="{{trans('lang.password_confirmation')}}"  value="" class="form-control  {{ $errors->has('password_confirmation') ? 'border-danger' : '' }}" type="password"
                                   maxlength="255" />

                            @if($errors->has('password_confirmation'))
                                <span  class="text-danger m-2 ">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button type="Submit" id="submit" class="btn btn-primary btn-default ">{{trans('lang.save')}}</button>
                        <a href="{{ URL::previous() }}" class="btn btn-secondary">{{trans('lang.cancel')}}</a>
                    </div>

                </form>
            </div>
        </div>

@endsection
@push('scripts')


    <script !src="">
        var avatar1 = new KTImageInput('kt_image_1');
    </script>

@endpush
