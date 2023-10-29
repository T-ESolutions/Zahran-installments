@php($title='سجل التحركات')
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
                <a href="{{route('admin')}}"
                   class="text-muted">{{trans('lang.dashboard')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admins')}}"
                   class="text-muted">{{trans('lang.admins')}}</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')
    <div class="card card-custom gutter-b">
        <!--Begin::Header-->
        <div class="card-header card-header-tabs-line">
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x"
                    role="tablist">
                    <li class="nav-item mr-3">
                        <a class="nav-link active" data-toggle="tab" href="#invoice_details_tab">
														<span class="nav-icon mr-2">
															<span class="svg-icon mr-3">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Devices/Display1.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<path
                                                                            d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z"
                                                                            fill="#000000" opacity="0.3"/>
																		<path
                                                                            d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z"
                                                                            fill="#000000"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
														</span>
                            <span class="nav-text font-weight-bold">التحركات في الفواتير والاقساط</span>
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4">
														<span class="nav-icon mr-2">
															<span class="svg-icon mr-3">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<path
                                                                            d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                                                                            fill="#000000" fill-rule="nonzero"/>
																		<circle fill="#000000" opacity="0.3" cx="12"
                                                                                cy="10" r="6"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
														</span>
                            <span class="nav-text font-weight-bold">التحركات في القضايا والانذارات</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">
														<span class="nav-icon mr-2">
															<span class="svg-icon mr-3">
																<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<path
                                                                            d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                                            fill="#000000"/>
																		<circle fill="#000000" opacity="0.3" cx="18.5"
                                                                                cy="5.5" r="2.5"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
														</span>
                            <span class="nav-text font-weight-bold">التحركات في اضافة العملاء</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--end::Header-->
        <!--Begin::Body-->
        <div class="card-body">
            <div class="tab-content pt-5">
                <!--begin::Tab Content-->
                <!--end::Tab Content-->
                <!--begin::Tab Content-->
                <div class="tab-pane active" id="invoice_details_tab" role="tabpanel">
                    <h3 class="text-primary">التحركات في الفواتير والاقساط</h3>
                    @include('Dashboard.admin.history_parts.installments')
                </div>
                <!--end::Tab Content-->
                <!--begin::Tab Content-->
                <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                    <h3 class="text-primary">التحركات في القضايا والانذارات</h3>

                    @include('Dashboard.admin.history_parts.law')

                </div>
                <!--end::Tab Content-->
                <!--begin::Tab Content-->
                <div class="tab-pane" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                    <h3 class="text-primary">التحركات في اضافة العملاء</h3>

                    @include('Dashboard.admin.history_parts.customers')
                </div>
                <!--end::Tab Content-->
            </div>
        </div>
        <!--end::Body-->
    </div>
@endsection

@push('scripts')
    <script>
        // tagging support
        $('#kt_select2_1_modal').select2({
            placeholder: "{{trans('lang.roles')}}",
            tags: true
        });
    </script>
@endpush
