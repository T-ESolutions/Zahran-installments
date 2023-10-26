@php($title=trans('lang.invoices_installments'))
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
                <a href="{{route('invoices.index')}}"
                   class="text-muted">{{trans('lang.invoices')}}</a>
            </li>

        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')
    @php(  $amount=null)
    @if($invoice->unPaidLawSuit->count() > 0)
        @php(  $amount= $invoice->unPaidLawSuit->sum('amount')-$invoice->unPaidLawSuit->sum('paid_amount'))
        <div class="alert alert-custom alert-outline-danger fade show mb-5 bg-white" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text h1"> يوجد قضيه علي هذه الفاتوره بقيمه {{ $amount }} </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="ki ki-close"></i>
                    </span>
                </button>
            </div>
        </div>
    @endif
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--Begin::Card-->
            <div class="card card-custom gutter-b">
                <!--Begin::Body-->
                <div class="card-body">
                    <div class="d-flex">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-50 symbol-lg-120 symbol-light-danger center">
                                <span class="font-size-h3 symbol-label font-weight-boldest" title="رقم الفاتورة">
                                {{$invoice->id}}
                                </span>

                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin: Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <!--begin::User-->
                                <div class="mr-3">
                                    <div class="d-flex align-items-center mr-3">
                                        <!--begin::Name-->
                                        <a href="javascript:void(0);"
                                           class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                            {{$invoice->customer->name}}</a>
                                        <!--end::Name-->
                                        <span
                                            class="label label-light-success label-xl label-inline font-weight-bolder mr-1">{{$invoice->transaction_number}}</span>
                                    </div>
                                    <!--begin::Contacts-->
                                    <div class="d-flex flex-wrap my-2">
                                        <a href="javascript:void(0);"
                                           class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<path
                                                                            d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                                            fill="#000000"/>
																		<circle fill="#000000" opacity="0.3" cx="19.5"
                                                                                cy="17.5" r="2.5"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>القسط الشهري :
                                            <span class="text-primary">{{$invoice->monthly_installment}}</span>
                                            </a>

                                        <a href="javascript:void(0);"
                                           class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<path
                                                                            d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                                            fill="#000000"/>
																		<circle fill="#000000" opacity="0.3" cx="19.5"
                                                                                cy="17.5" r="2.5"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>حالة الفاتورة : <span class="text-primary">{{trans('lang.invoice_status_'.$invoice->status)}}</span></a>


                                    </div>
                                    <div class="d-flex flex-wrap my-2">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#pay_installment">
                                            <i class="flaticon-coins"></i>

                                            @lang('lang.pay_installment')
                                        </button>
                                        <div class="modal fade" id="pay_installment" data-backdrop="static"
                                             tabindex="-1"
                                             role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">@lang('lang.pay_installment')</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <div class="form-group  col-12">
                                                            <label>{{trans('lang.pay_installment')}}<span
                                                                    class="text-danger">*</span></label>

                                                            <input name="amount"
                                                                   placeholder="{{trans('lang.pay_installment')}}"
                                                                   class="form-control" type="number"
                                                                   maxlength="255"/>

                                                            <span class="text-danger errors form_error_amount"
                                                                  role="alert"></span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-light-primary font-weight-bold "
                                                                data-dismiss="modal">@lang('lang.cancel')</button>
                                                        <button type="button" data-id="{{$invoice->id}}"
                                                                class="btn btn-primary font-weight-bold pay_installment">@lang('lang.save')</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                                <!--begin::User-->
                                <!--begin::Actions-->
                                <div class="mb-10" style="text-align: center;">
                                    {{--                                    <a href="javascript:void(0);"--}}
                                    {{--                                       class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">contact</a>--}}

                                    @if(!$invoice->customer->is_late)
                                        @can('update-customer')
                                            <a href="{{route('customers.addToLateCustomersList',$invoice->customer->id)}}"
                                               type="submit"
                                               class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase mr-2">
                                                <i class="flaticon2-plus"></i>
                                                @lang('lang.add_to_late_customers_list')
                                            </a>
                                        @endcan
                                    @else
                                        <h6 class="font-weight-bolder text-dark mb-0">العميل مضاف لقائمة
                                            المتأخرين</h6>
                                        &nbsp;
                                        &nbsp;
                                        <a
                                            href="{{route('customers.addToLateCustomersList',$invoice->customer->id)}}"
                                            class="btn btn-light-danger"
                                            title="الحذف من قائمة المتأخرين"><i
                                                class="fa fa-trash"></i></a>
                                    @endif

                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                                <!--begin::Description-->
                                <div class="flex-grow-1 text-muted-50 py-2 py-lg-2 mr-5">{{$invoice->note}}
                                </div>
                                <!--end::Description-->
                                <!--begin::Progress-->
                                <div class="d-flex mt-4 mt-sm-0">

                                    {{--                                    <span class="font-weight-bold mr-4">احصائيات دفع الاقساط </span>--}}
                                    {{--                                    <div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">--}}
                                    {{--                                        <div class="progress-bar bg-success" role="progressbar" style="width: 63%;"--}}
                                    {{--                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <span class="font-weight-bolder text-dark ml-4">78%</span>--}}
                                </div>
                                <!--end::Progress-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--End::Card-->
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <!--Begin::Header-->
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x"
                            role="tablist">
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#invoice_details_tab">
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
                                    <span class="nav-text font-weight-bold">بيانات الفاتورة</span>
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
                                    <span class="nav-text font-weight-bold">الضامنين</span>
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
                                    <span class="nav-text font-weight-bold">وصلات الامانة</span>
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
                        <div class="tab-pane" id="invoice_details_tab" role="tabpanel">
                            @include('Dashboard.Invoice.parts.show_invoice_data')
                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Tab Content-->
                        <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                            @include('Dashboard.Invoice.parts.show_guarantors')

                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Tab Content-->
                        <div class="tab-pane" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                            @include('Dashboard.Invoice.parts.show_papers')
                        </div>
                        <!--end::Tab Content-->
                    </div>
                </div>
                <!--end::Body-->
            </div>

            <div class="card card-custom gutter-b">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">الاقساط</div>
                </div>
                <!--Begin::Body-->
                <div class="card-body">
                    {!! $dataTable->table() !!}
                </div>
            </div>
            <div class="card card-custom">
                <div class="card-body">
                    <button type="button" class="btn btn-success finish_invoice " data-toggle="modal" data-invoice_id="{{$invoice->id}}"
                            >
                        <i class="flaticon2-check-mark"></i>

                        انهاء الفاتورة
                    </button>
                </div>
            </div>

            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>


@endsection
@push('scripts')

    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function () {
            $('body').on('click', '.pay_installment', function (event) {
                event.preventDefault();

                let amount = $(this).parent().parent().parent().find('.form-control').val();
                let id = $(this).attr('data-id');
                let data = new FormData();

                data.append('amount', amount);
                data.append('invoice_id', id);

                let message = ' دفع قيمه ' + amount + ' ؟';

                @if($amount)
                if (`{{$amount}}` > 0) {
                    message = ' دفع قيمه ' + amount + ' و تسديد قيمه القضيه ' + `{{$amount}}` + ' اولا ؟ ';
                }
                @endif


                Swal.fire({
                        icon: 'warning',
                        title: message,
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'نعم',
                        cancelButtonText: 'لا, الغاء'
                    }
                ).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: `{{route('invoices.installments.pay')}}`,
                            method: 'post',
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (response) {
                                $('#InvoiceInstallments-table').DataTable().ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: response.success,
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'تم'
                                })

                                $('#sum_remaining_amount').text(response.new_amount);
                                $('.errors').empty();

                                //close model
                                $('#pay_installment').modal('hide');
                            },
                            error: function (data) {
                                if (data.status === 422) {
                                    $('.errors').empty();
                                    $.each(JSON.parse(data.responseText).errors, function (key, value) {
                                        if (!key.search("dates")) {
                                            var arr = key.split(".");
                                            $('.errors').show();
                                            $('.error_dates' + arr[1] + arr[2]).show();
                                            $(document).find('.error_dates' + arr[1] + arr[2]).html(JSON.parse(data.responseText).errors[key]);
                                            console.log(JSON.parse(data.responseText).errors[key]);
                                        } else {
                                            $('.errors').show();
                                            $('.form_error_' + key).show();
                                            $(document).find('.form_error_' + key).html(JSON.parse(data.responseText).errors[key]);
                                        }
                                    });
                                }
                            }
                        });
                    }
                });

            })

        });
        $(document).ready(function () {
            $('body').on('click', '.add_notes_btn', function (event) {
                event.preventDefault();
                let id = $(this).attr('data-id');
                let notes = $(this).parent().parent().parent().find('.notes_txt').val();
                let data = new FormData();
                data.append('id', id);
                data.append('notes', notes);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: `{{route('invoices.installments.add.notes')}}`,
                    method: 'post',
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        $('#InvoiceInstallments-table').DataTable().ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: response.success,
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'تم'
                        })
                        $('.errors').empty();

                        //close model
                        $('#notes_model' + id).modal('hide');
                    },
                    error: function (data) {
                        if (data.status === 422) {
                            $('.errors').empty();
                            $.each(JSON.parse(data.responseText).errors, function (key, value) {
                                if (!key.search("dates")) {
                                    var arr = key.split(".");
                                    $('.errors').show();
                                    $('.error_dates' + arr[1] + arr[2]).show();
                                    $(document).find('.error_dates' + arr[1] + arr[2]).html(JSON.parse(data.responseText).errors[key]);
                                    console.log(JSON.parse(data.responseText).errors[key]);
                                } else {
                                    $('.errors').show();
                                    $('.form_error_' + key).show();
                                    $(document).find('.form_error_' + key).html(JSON.parse(data.responseText).errors[key]);
                                }
                            });
                        }
                    }
                });
            })

        });

        $(document).ready(function () {
            $('body').on('click', '.changeDateInstallment', function (event) {
                event.preventDefault();
                let id = $(this).attr('data-id');
                let pay_date = $(this).parent().parent().parent().find('.form-control').val();
                let data = new FormData();

                data.append('id', id);
                data.append('pay_date', pay_date);

                Swal.fire({
                    icon: 'warning',
                    title: ' تغير القسط الي تاريخ ' + pay_date + ' ؟',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا, الغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: `{{route('invoices.installments.change.date')}}`,
                            method: 'post',
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (response) {
                                $('#InvoiceInstallments-table').DataTable().ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: response.success,
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'تم'
                                })
                                $('.errors').empty();

                                //close model
                                $('#changeDateModal' + id).modal('hide');
                            },
                            error: function (data) {
                                if (data.status === 422) {
                                    $('.errors').empty();
                                    $.each(JSON.parse(data.responseText).errors, function (key, value) {
                                        if (!key.search("dates")) {
                                            var arr = key.split(".");
                                            $('.errors').show();
                                            $('.error_dates' + arr[1] + arr[2]).show();
                                            $(document).find('.error_dates' + arr[1] + arr[2]).html(JSON.parse(data.responseText).errors[key]);
                                            console.log(JSON.parse(data.responseText).errors[key]);
                                        } else {
                                            $('.errors').show();
                                            $('.form_error_' + key).show();
                                            $(document).find('.form_error_' + key).html(JSON.parse(data.responseText).errors[key]);
                                        }
                                    });
                                }
                            }
                        });
                    }
                });

            })

        });

 $(document).ready(function () {
            $('body').on('click', '.finish_invoice', function (event) {
                event.preventDefault();
                let id = $(this).data('invoice_id');
                let data = new FormData();
                data.append('id', id);
                Swal.fire({
                    icon: 'warning',
                    title: ' هل تريد انهاء الفاتورة ؟ ',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا, الغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: `{{route('invoices.finish')}}`,
                            method: 'post',
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (response) {
                                if(response.status ==  true){
                                    $('#InvoiceInstallments-table').DataTable().ajax.reload();
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.success,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                    $('.errors').empty();

                                    //close model
                                    $('#changeDateModal' + id).modal('hide');
                                }else{
                                    Swal.fire({
                                        icon: 'warning',
                                        title: response.msg,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                }

                            },
                            error: function (data) {
                                if (data.status === 422) {
                                    $('.errors').empty();
                                    $.each(JSON.parse(data.responseText).errors, function (key, value) {
                                        if (!key.search("dates")) {
                                            var arr = key.split(".");
                                            $('.errors').show();
                                            $('.error_dates' + arr[1] + arr[2]).show();
                                            $(document).find('.error_dates' + arr[1] + arr[2]).html(JSON.parse(data.responseText).errors[key]);
                                            console.log(JSON.parse(data.responseText).errors[key]);
                                        } else {
                                            $('.errors').show();
                                            $('.form_error_' + key).show();
                                            $(document).find('.form_error_' + key).html(JSON.parse(data.responseText).errors[key]);
                                        }
                                    });
                                }
                            }
                        });
                    }
                });

            })

        });

        $(document).ready(function () {
            $('body').on('click', '.postingInstallmentButton', function (event) {
                event.preventDefault();
                let id = $(this).attr('data-id');
                let days_count = $(this).parent().parent().parent().find('.form-control').val();
                let data = new FormData();

                data.append('id', id);
                data.append('days_count', days_count);

                Swal.fire({
                    icon: 'warning',
                    title: ' تأجيل القسط ' + days_count + ' يوم ؟',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا, الغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: `{{route('invoices.posting.installments')}}`,
                            method: 'post',
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (response) {
                                if (response.status == false) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: response.msg,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                    //close model
                                    $('#postingInstallment' + id).modal('hide');
                                } else {
                                    $('#InvoiceInstallments-table').DataTable().ajax.reload();
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.success,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                    $('.errors').empty();

                                    //close model
                                    $('#postingInstallment' + id).modal('hide');
                                }

                            },
                            error: function (data) {
                                if (data.status === 422) {
                                    $('.errors').empty();
                                    $.each(JSON.parse(data.responseText).errors, function (key, value) {
                                        if (!key.search("dates")) {
                                            var arr = key.split(".");
                                            $('.errors').show();
                                            $('.error_dates' + arr[1] + arr[2]).show();
                                            $(document).find('.error_dates' + arr[1] + arr[2]).html(JSON.parse(data.responseText).errors[key]);
                                            console.log(JSON.parse(data.responseText).errors[key]);
                                        } else {
                                            $('.errors').show();
                                            $('.form_error_' + key).show();
                                            $(document).find('.form_error_' + key).html(JSON.parse(data.responseText).errors[key]);
                                        }
                                    });
                                }
                            }
                        });
                    }
                });

            })

        });

        $(document).ready(function () {
            $('body').on('click', '.monthPostingInstallmentButton', function (event) {
                event.preventDefault();
                let id = $(this).attr('data-id');


                Swal.fire({
                    icon: 'warning',
                    title: ' ترحيل القسط الى الشهر القادم ودمج المبلغ معاّ ؟',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا, الغاء'

                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        let data = new FormData();
                        data.append('id', id);

                        $.ajax({
                            url: `{{route('invoices.month.posting.installments')}}`,
                            method: 'post',
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (response) {
                                if (response.status == false) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: response.msg,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                    //close model
                                    $('#postingInstallment' + id).modal('hide');
                                } else {
                                    $('#InvoiceInstallments-table').DataTable().ajax.reload();

                                    Swal.fire({
                                        icon: 'success',
                                        title: response.success,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                    $('.errors').empty();
                                }
                            },
                            error: function (data) {
                                if (data.status === 422) {
                                    $('.errors').empty();
                                    $.each(JSON.parse(data.responseText).errors, function (key, value) {
                                        if (!key.search("dates")) {
                                            var arr = key.split(".");
                                            $('.errors').show();
                                            $('.error_dates' + arr[1] + arr[2]).show();
                                            $(document).find('.error_dates' + arr[1] + arr[2]).html(JSON.parse(data.responseText).errors[key]);
                                            console.log(JSON.parse(data.responseText).errors[key]);
                                        } else {
                                            $('.errors').show();
                                            $('.form_error_' + key).show();
                                            $(document).find('.form_error_' + key).html(JSON.parse(data.responseText).errors[key]);
                                        }
                                    });
                                }
                            }
                        });
                    }
                });

            })

        });
    </script>

@endpush

