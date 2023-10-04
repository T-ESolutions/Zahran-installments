@php($title=trans('lang.create-installment_request'))
@extends('adminLayouts.app')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Breadcrumb-->
        <h5 class="text-dark  font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"
                   class="text-muted">{{trans('lang.dashboard')}}</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{route('installment_requests.index')}}"
                   class="text-muted">{{trans('lang.installment_request')}}</a>
            </li>


        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post"  id="form" action="{{route('installment_requests.store')}}" enctype="multipart/form-data">
                @csrf
                @include('Dashboard.InstallmentRequest.form')
            </form>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
