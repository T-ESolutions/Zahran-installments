@php($title=trans('lang.dashboard'))
@extends('adminLayouts.app')
@section('title')
    {{ env('APP_NAME') }}

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 col-xxl-4">
            <!--begin::Mixed Widget 1-->
            <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 bg-danger py-5">
                    <h3 class="card-title font-weight-bolder text-white">الاحصائيات</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0 position-relative overflow-hidden">
                    <!--begin::Chart-->
                    <div id="statistics_chart" class="card-rounded-bottom bg-danger" style="height: 200px"></div>
                    <!--end::Chart-->
                    <!--begin::Stats-->
                    <div class="card-spacer mt-n25">
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
															<span
                                                                class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<rect fill="#000000" opacity="0.3" x="13" y="4"
                                                                              width="3" height="16" rx="1.5"/>
																		<rect fill="#000000" x="8" y="9" width="3"
                                                                              height="11" rx="1.5"/>
																		<rect fill="#000000" x="18" y="11" width="3"
                                                                              height="9" rx="1.5"/>
																		<rect fill="#000000" x="3" y="13" width="3"
                                                                              height="7" rx="1.5"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
                                <a href="{{route('invoices.index')}}"
                                   class="text-warning font-weight-bold font-size-h6">{{__('lang.invoices')}}
                                    : {{$data['invoices']}}</a>
                            </div>
                            <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
															<span
                                                                class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24"/>
																		<path
                                                                            d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                                            fill="#000000" fill-rule="nonzero"
                                                                            opacity="0.3"/>
																		<path
                                                                            d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                                            fill="#000000" fill-rule="nonzero"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
                                <a href="{{route('customers.index')}}"
                                   class="text-primary font-weight-bold font-size-h6 mt-2">{{trans('lang.customers')}}
                                    : {{$data['customers']}}</a>
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7">
															<span
                                                                class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24"/>
																		<path
                                                                            d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                                            fill="#000000" fill-rule="nonzero"/>
																		<path
                                                                            d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                                            fill="#000000" opacity="0.3"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
                                <a href="javascript:void(0);" class="text-danger font-weight-bold font-size-h6 mt-2">القائمة
                                    السوداء {{$data['customers_blocked']}}</a>
                            </div>
                            <div class="col bg-light-success px-6 py-8 rounded-xl">
															<span
                                                                class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<path
                                                                            d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z"
                                                                            fill="#000000" opacity="0.3"/>
																		<path
                                                                            d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z"
                                                                            fill="#000000"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
                                <a href="javascript:void(0);" class="text-success font-weight-bold font-size-h6 mt-2">طلبات
                                    التقسيط {{$data['installment_requests']}}</a>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 1-->
        </div>
        <div class="col-lg-6 col-xxl-8">
            <!--begin::List Widget 9-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="font-weight-bolder text-dark">التقرير اليومي</span>
                        <span
                            class="text-primary mt-3 font-weight-bold font-size-sm">{{\Carbon\Carbon::now()->format('Y-m-d')}}</span>
                    </h3>

                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::Timeline-->
                    <div class="scroll pr-7 mr-n7 ps ps--active-y" data-scroll="true" data-height="400"
                         data-mobile-height="200" style="height: 400px; overflow: hidden;">
                        <div class="timeline timeline-6 mt-3">
                        @foreach($daily_history as $row)
                            <!--begin::Item-->
                                <div class="timeline-item align-items-start">
                                    <!--begin::Label-->
                                    <div
                                        class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$row->created_at->format('H:i')}}</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-warning icon-xl"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Text-->
                                    <div
                                        class="timeline-content font-weight-bolder text-dark-75 pl-3 font-size-lg">{{$row->description}}
                                        <span class="text-primary">المشرف : {{$row->created_by->name}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            @endforeach
                        </div>
                    </div>
                    <!--end::Timeline-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end: List Widget 9-->
        </div>
        <div class="col-xxl-12 order-2 order-xxl-1">
            <!--begin::Advance Table Widget 2-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">الاقساط</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-dark-75">

                            <li class="nav-item">
                                <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#tab_installment_today">اليوم
                                    الحالي</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-2 px-4" data-toggle="tab" href="#tab_installment_month">الشهر
                                    الحالي</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-2 px-4" data-toggle="tab"
                                   href="#tab_installment_late">المتأخره</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2 pb-0 mt-n3">
                    <div class="tab-content mt-5" id="myTabTables11">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade  show active" id="tab_installment_today" role="tabpanel"
                             aria-labelledby="tab_installment_today">
                            <!--begin::Table-->
                            <h3 class="text-primary">اليوم الحالي</h3>
                            <div class="scroll pr-7 mr-n7 ps ps--active-y" data-scroll="true" data-height="400"
                                 data-mobile-height="200" style="height: 400px; overflow: hidden;">
                                <div class="table-responsive">
                                    <table
                                        class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                        <thead>
                                        <tr>
                                            <th class="pl-7 text-left  ">الفاتورة</th>
                                            <th class="p-0 min-w-150px">العميل</th>
                                            <th class="p-0 min-w-125px text-center">رقم القسط</th>
                                            <th class="p-0 min-w-125px text-center">يوم السداد</th>
                                            <th class="p-0 min-w-125px text-center">القسط الشهري</th>
                                            <th class="p-0 min-w-100px text-center">المبلغ المدفوع</th>
                                            <th class="p-0 min-w-100px text-center">المبلغ المتبقي</th>
                                            <th class="p-0 min-w-110px text-center">الحالة</th>
                                            <th class="p-0 min-w-150px text-center">ملاحظات</th>
                                            <th class="p-0 min-w-150px text-center">الاجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($today_installments) == 0)
                                            <tr>
                                                <td class="text-center" colspan="10">
                                                    <h4 class="text-danger">لا يوجد اقساط اليوم </h4>
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach($today_installments as $row)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <div class="symbol symbol-50 symbol-light-danger">
                                                        <span class="font-size-h3 symbol-label font-weight-boldest"
                                                              title="رقم الفاتورة">
                                                        {{$row->invoice_id}}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$row->invoice ? $row->invoice->customer ? $row->invoice->customer->name : '' : ''}}</a>
                                                    <div>
                                                        <span class="font-weight-bolder">Code:</span>
                                                        <a class="text-muted font-weight-bold text-hover-primary"
                                                           href="javascript:void(0);">{{$row->invoice ? $row->invoice->transaction_number: '' }}</a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                <span
                                                    class="label label-lg label-light-info label-inline">{{$row->id}} </span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->pay_date}} </span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->monthly_installment}} جنية</span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->paid_amount}} جنية</span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->monthly_installment - $row->paid_amount}} جنية</span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">

                                                <span
                                                    class="label label-lg label-light-success label-inline">{{trans('lang.status_'.$row->status)}} </span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->notes}} </span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center pr-0">
                                                    <a href="{{route('invoices.installments',$row->invoice_id)}}"
                                                       class="btn btn-icon btn-light-primary btn-hover-primary btn-sm">
                                                        <i class="flaticon-eye"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->
                        <div class="tab-pane fade" id="tab_installment_month" role="tabpanel"
                             aria-labelledby="tab_installment_month">
                            <!--begin::Table-->
                            <div class="row">
                                <div class="col-md-6  text-left">

                                    <h3 class="text-primary ">الشهر الحالي</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class=" btn btn-light-success  py-2 px-4"
                                       href="{{route('home.export.monthInstallments')}}"> <i
                                            class="fa fa-download"> </i>تصدير excel</a>
                                </div>
                            </div>
                            <div class="scroll pr-7 mr-n7 ps ps--active-y" data-scroll="true" data-height="400"
                                 data-mobile-height="200" style="height: 400px; overflow: hidden;">
                                <div class="table-responsive">
                                    <table
                                        class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                        <thead>
                                        <tr>
                                            <th class="pl-7 text-left ">الفاتورة</th>
                                            <th class="p-0 min-w-200px">العميل</th>
                                            <th class="p-0 min-w-125px text-center">رقم القسط</th>
                                            <th class="p-0 min-w-125px text-center">يوم السداد</th>
                                            <th class="p-0 min-w-125px text-center">القسط الشهري</th>
                                            <th class="p-0 min-w-100px text-center">المبلغ المدفوع</th>
                                            <th class="p-0 min-w-100px text-center">المبلغ المتبقي</th>
                                            <th class="p-0 min-w-110px text-center">الحالة</th>
                                            <th class="p-0 min-w-150px text-center">ملاحظات</th>
                                            <th class="p-0 min-w-150px text-center">الاجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($month_installments) == 0)
                                            <tr>
                                                <td class="text-center" colspan="10">
                                                    <h4 class="text-danger">لا يوجد اقساط اليوم </h4>
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach($month_installments as $row)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <div class="symbol symbol-50 symbol-light-danger">
                                                        <span class="font-size-h3 symbol-label font-weight-boldest"
                                                              title="رقم الفاتورة">
                                                        {{$row->invoice_id}}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$row->invoice ? $row->invoice->customer ? $row->invoice->customer->name : '' : ''}}</a>
                                                    <div>
                                                        <span class="font-weight-bolder">Code:</span>
                                                        <a class="text-muted font-weight-bold text-hover-primary"
                                                           href="javascript:void(0);">{{$row->invoice ? $row->invoice->transaction_number: '' }}</a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                <span
                                                    class="label label-lg label-light-info label-inline">{{$row->id}} </span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->pay_date}} </span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->monthly_installment}} جنية</span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->paid_amount}} جنية</span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->monthly_installment - $row->paid_amount}} جنية</span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">

                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('lang.status_'.$row->status)}} </span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->notes}} </span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center pr-0">
                                                    <a href="{{route('invoices.installments',$row->invoice_id)}}"
                                                       class="btn btn-icon btn-light-primary btn-hover-primary btn-sm">
                                                        <i class="flaticon-eye"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="tab_installment_late" role="tabpanel"
                             aria-labelledby="tab_installment_late">
                            <!--begin::Table-->
                            <div class="row">
                                <div class="col-md-6  text-left">

                                    <h3 class="text-primary ">المتأخره</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class=" btn btn-light-success  py-2 px-4"
                                       href="{{route('home.export.lateInstallments')}}"> <i
                                            class="fa fa-download"> </i>تصدير excel</a>
                                </div>
                            </div>
                            <div class="scroll pr-7 mr-n7 ps ps--active-y" data-scroll="true" data-height="400"
                                 data-mobile-height="200" style="height: 400px; overflow: hidden;">
                                <div class="table-responsive">
                                    <table
                                        class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                        <thead>
                                        <tr>
                                            <th class="pl-7 text-left ">الفاتورة</th>
                                            <th class="p-0 min-w-200px">العميل</th>
                                            <th class="p-0 min-w-125px text-center">رقم القسط</th>
                                            <th class="p-0 min-w-125px text-center">يوم السداد</th>
                                            <th class="p-0 min-w-125px text-center">القسط الشهري</th>
                                            <th class="p-0 min-w-100px text-center">المبلغ المدفوع</th>
                                            <th class="p-0 min-w-100px text-center">المبلغ المتبقي</th>
                                            <th class="p-0 min-w-110px text-center">ايام التأخر</th>
                                            <th class="p-0 min-w-150px text-center">ملاحظات</th>
                                            <th class="p-0 min-w-150px text-center">الاجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($late_installments) == 0)
                                            <tr>
                                                <td class="text-center" colspan="9">
                                                    <h4 class="text-danger">لا يوجد اقساط متأخره </h4>
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach($late_installments as $row)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <div class="symbol symbol-50 symbol-light-danger">
                                                        <span class="font-size-h3 symbol-label font-weight-boldest"
                                                              title="رقم الفاتورة">
                                                        {{$row->invoice_id}}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$row->invoice ? $row->invoice->customer ? $row->invoice->customer->name : '' : ''}}</a>
                                                    <div>
                                                        <span class="font-weight-bolder">Code:</span>
                                                        <a class="text-muted font-weight-bold text-hover-primary"
                                                           href="javascript:void(0);">{{$row->invoice ? $row->invoice->transaction_number: '' }}</a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                <span
                                                    class="label label-lg label-light-info label-inline">{{$row->id}} </span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->pay_date}} </span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->monthly_installment}} جنية</span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->paid_amount}} جنية</span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->monthly_installment - $row->paid_amount}} جنية</span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center">
                                                <span
                                                    class="label label-lg label-light-danger label-inline">{{$row->late_days}} </span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->notes}} </span>
                                                    {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                                                </td>
                                                <td class="text-center pr-0">
                                                    <a href="{{route('invoices.installments',$row->invoice_id)}}"
                                                       class="btn btn-icon btn-light-primary btn-hover-primary btn-sm">
                                                        <i class="flaticon-eye"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 2-->
        </div>

    </div>

@endsection
@push('scripts')
    <script>
        var KTWidgets = function () {
            // Mixed widgets
            var _statistics_chart = function () {
                var element = document.getElementById("statistics_chart");
                var height = parseInt(KTUtil.css(element, 'height'));

                if (!element) {
                    return;
                }

                var strokeColor = '#D13647';

                // var options = {
                //     series: [{
                //         name: 'Net Profit',
                //         data: [40, 40, 40, 40, 40, 40, 40]
                //     }],
                //     chart: {
                //         type: 'area',
                //         height: height,
                //         toolbar: {
                //             show: false
                //         },
                //         zoom: {
                //             enabled: false
                //         },
                //         sparkline: {
                //             enabled: true
                //         },
                //         dropShadow: {
                //             enabled: true,
                //             enabledOnSeries: undefined,
                //             top: 5,
                //             left: 0,
                //             blur: 3,
                //             color: strokeColor,
                //             opacity: 0.5
                //         }
                //     },
                //     plotOptions: {},
                //     legend: {
                //         show: false
                //     },
                //     dataLabels: {
                //         enabled: false
                //     },
                //     fill: {
                //         type: 'solid',
                //         opacity: 0
                //     },
                //     stroke: {
                //         curve: 'smooth',
                //         show: true,
                //         width: 3,
                //         colors: [strokeColor]
                //     },
                //     xaxis: {
                //         categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                //         axisBorder: {
                //             show: false,
                //         },
                //         axisTicks: {
                //             show: false
                //         },
                //         labels: {
                //             show: false,
                //             style: {
                //                 colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                //                 fontSize: '12px',
                //                 fontFamily: KTApp.getSettings()['font-family']
                //             }
                //         },
                //         crosshairs: {
                //             show: false,
                //             position: 'front',
                //             stroke: {
                //                 color: KTApp.getSettings()['colors']['gray']['gray-300'],
                //                 width: 1,
                //                 dashArray: 3
                //             }
                //         }
                //     },
                //     yaxis: {
                //         min: 0,
                //         max: 80,
                //         labels: {
                //             show: false,
                //             style: {
                //                 colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                //                 fontSize: '12px',
                //                 fontFamily: KTApp.getSettings()['font-family']
                //             }
                //         }
                //     },
                //
                //     tooltip: {
                //         style: {
                //             fontSize: '12px',
                //             fontFamily: KTApp.getSettings()['font-family']
                //         },
                //         y: {
                //             formatter: function (val) {
                //                 return "$" + val + " thousands"
                //             }
                //         },
                //         marker: {
                //             show: false
                //         }
                //     },
                //     colors: ['transparent'],
                //     markers: {
                //         colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
                //         strokeColor: [strokeColor],
                //         strokeWidth: 3
                //     }
                // };

                var chart = new ApexCharts(element, options);
                chart.render();
            }
            // Public methods
            return {
                init: function () {

                    _statistics_chart();

                }
            }
        }();
    </script>
@endpush
