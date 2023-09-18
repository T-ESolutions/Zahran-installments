@php($title=trans('lang.show-customer'))
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
            <li class="breadcrumb-item">
                <a href="{{route('customers.index')}}"
                   class="text-muted">{{trans('lang.customers')}}</a>
            </li>

        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="d-flex">
                <!--begin: Pic-->

                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-120">
                        <img alt="Pic" src="{{url($data->id_image)}}">
                    </div>

                </div>
                <!--end: Pic-->
                <!--begin: Info-->
                <div class="flex-grow-1">
                    <!--begin: Title-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mr-3">
                            <!--begin::Name-->
                            <a class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{$data->name}}

                                @if(!$data->is_blocked)

                                    <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                            @else
                                <i class="flaticon2-cross text-danger icon-md ml-2"></i></a
                            @endif
                            <!--end::Name-->
                            <!--begin::Contacts-->
                            <div class="d-flex flex-wrap my-2">
                                <a class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
														<i class="flaticon2-phone text-primary icon-md ml-2"></i>
                                                                <!--end::Svg Icon-->
															</span>{{$data->phone}}</a>


                                @if($data->phone2)
                                    <a class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
														<i class="flaticon2-phone text-primary icon-md ml-2"></i>
                                                                <!--end::Svg Icon-->
															</span>{{$data->phone2}}</a>

                                @endif

                                @if($data->phone3)
                                    <a class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
														<i class="flaticon2-phone text-primary icon-md ml-2"></i>
                                                                <!--end::Svg Icon-->
															</span>{{$data->phone3}}</a>

                                @endif
                            </div>

                            <!--end::Contacts-->
                        </div>
                    </div>
                    <!--end: Title-->
                    <!--begin: Content-->
                    <div class="d-flex align-items-center flex-wrap justify-content-between row">


                        <div class="d-flex flex-wrap align-items-center py-2 col-6">
                            <div class="d-flex align-items-center mr-10 row">
                                <div class="mr-6 col-12">
                                    <div class="font-weight-bold mb-2">@lang('lang.address')</div>
                                    <span
                                        class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{$data->address}}</span>
                                </div>
                                <div class="mr-6  col-12">
                                    <div class="font-weight-bold mb-2">@lang('lang.address_id')</div>
                                    <span
                                        class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{$data->address_id}}</span>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center py-2 col-6">
                            <div class="d-flex align-items-center mr-10">
                                <div class="mr-6">
                                    <div class="font-weight-bold mb-2">@lang('lang.id_number')</div>
                                    <span
                                        class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{$data->id_number}}</span>
                                </div>
                                <div class="mr-6">
                                    <div class="font-weight-bold mb-2">@lang('lang.governorate')</div>
                                    <span
                                        class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{$data->governorate}}</span>
                                </div>
                                <div class="mr-6">
                                    <div class="font-weight-bold mb-2">@lang('lang.center')</div>
                                    <span
                                        class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{$data->center}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center py-2 col-12">
                            <div class="d-flex align-items-center mr-10">
                                <div class="mr-6">
                                    <div class="font-weight-bold mb-2">@lang('lang.note')</div>
                                    <span
                                        class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{$data->note}}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end: Content-->
                </div>
                <!--end: Info-->
            </div>

        </div>
    </div>
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="example-preview">
                <span
                    class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">@lang('lang.relatives')</span>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">@lang('lang.name')</th>
                        <th scope="col">@lang('lang.id_number')</th>
                        <th scope="col">@lang('lang.note')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data->relatives as $key=>$rel)

                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$rel->name}}</td>
                            <td>{{$rel->phone}}</td>
                            <td>{{$rel->note}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="example-preview">
                <span
                    class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">@lang('lang.invoices')</span>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">@lang('lang.invoice_number')</th>
                        <th scope="col">@lang('lang.invoice_date')</th>
                        <th scope="col">@lang('lang.transaction_number')</th>
                        <th scope="col">@lang('lang.product')</th>
                        <th scope="col">@lang('lang.total_price')</th>
                        <th scope="col">@lang('lang.deposit')</th>
                        <th scope="col">@lang('lang.profit')</th>
                        <th scope="col">@lang('lang.created_by')</th>
                        <th scope="col">@lang('lang.late_installment')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data->invoices as $key=>$invoice)

                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$invoice->invoice_number}}</td>
                            <td>{{$invoice->invoice_date}}</td>
                            <td>{{$invoice->transaction_number}}</td>
                            <td>{{$invoice->product}}</td>
                            <td>{{$invoice->total_price}}</td>
                            <td>{{$invoice->deposit}}</td>
                            <td>{{$invoice->profit}}</td>
                            <td>{{$invoice->admin->name}}</td>
                            <td>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('lang.price')</th>
                                        <th scope="col">@lang('lang.pay_date')</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach($invoice->unInstallments as $key2=>$installment)
                                        <tr>
                                            <th scope="row">{{$key2+1}}</th>
                                            <th scope="row">{{$installment->monthly_installment}}</th>
                                            <th scope="row">{{$installment->pay_date}}</th>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
@push('scripts')

@endpush

