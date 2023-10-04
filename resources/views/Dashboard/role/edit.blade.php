@php($title=trans('lang.edit_role'))
@extends('adminLayouts.app')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Breadcrumb-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('roles')}}"
                   class="text-muted">{{trans('lang.roles')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin')}}"
                   class="text-muted">{{trans('lang.dashboard')}}</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')
    <form method="post" action="{{route('roles.update',$role->id)}}" enctype="multipart/form-data">
        @include('Dashboard.role.form')
    </form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form', function () {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endpush

