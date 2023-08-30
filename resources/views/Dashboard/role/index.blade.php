@php($title=trans('lang.roles'))
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
                <a href="{{route('admin')}}"
                   class="text-muted">{{trans('lang.dashboard')}}</a>
            </li>

        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

    <div class="card">
        <div class="text-right">
            <div class="card-header">
                @can('create-roles')
                    <a href="{{route('roles.create')}}" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">
                        <i class="fa fa-plus"></i>{{trans('lang.create')}}</a>
                @endcan
            </div>
        </div>

        <div class="card-body">
            {!! $dataTable->table() !!}

        </div>
    </div>


@endsection
@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush

