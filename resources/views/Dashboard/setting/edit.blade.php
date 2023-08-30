@php($title=trans('lang.settings'))
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
            <li class="breadcrumb-item text-warning">
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
            <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                @csrf
                @include('Dashboard.setting.form')
            </form>
        </div>
    </div>


@endsection
@push('scripts')
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_1');
        var avatar1 = new KTImageInput('kt_image_2');
    </script>
@endpush

