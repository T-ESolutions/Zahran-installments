@php($title=trans('lang.dashboard'))
@extends('adminLayouts.app')
@section('title')
    {{ env('APP_NAME') }}

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h5 class="text-primary  font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <div class="row">

           @foreach($data as $key => $value)

        <div class="col-md-3 col-sm-6">
            <!--begin::Stats Widget 15-->
            <span href="#" class="card card-custom bg-primary text-center bg-hover-state-success card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
				 	<h1 class="text-dark"  > {{$value}} </h1>
                    <div class="text-inverse-success font-weight-bolder font-size-h5 mb-2 mt-5">{{trans('lang.'.$key)}}</div>
                    <div class="font-weight-bold text-inverse-success font-size-sm"> </div>
                </div>
                <!--end::Body-->
            </span>
            <!--end::Stats Widget 15-->
        </div>
        @endforeach

    </div>
@endsection
