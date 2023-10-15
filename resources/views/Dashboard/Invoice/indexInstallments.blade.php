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

    <div class="card">
        <div class="text-right">
            <div class="card-header">
                <div class="row text-center">
                    <div class="col-md-6">
                        <div>


                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#pay_installment">
                                @lang('lang.pay_installment')
                            </button>

                            <div class="modal fade" id="pay_installment" data-backdrop="static" tabindex="-1"
                                 role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="exampleModalLabel">@lang('lang.pay_installment')</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body row">
                                            <div class="form-group  col-12">
                                                <label>{{trans('lang.pay_installment')}}<span
                                                        class="text-danger">*</span></label>

                                                <input name="amount" placeholder="{{trans('lang.pay_installment')}}"
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


                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.invoice_number') </span>
                                <span class="font-weight-bold ">{{$invoice->invoice_number}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.transaction_number') </span>
                                <span class="font-weight-bold ">{{$invoice->transaction_number}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.product') </span>
                                <span class="font-weight-bold ">{{$invoice->product}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.total_price') </span>
                                <span class="font-weight-bold ">{{$invoice->total_price}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.deposit') </span>
                                <span class="font-weight-bold ">{{$invoice->deposit}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.remaining_price') </span>
                                <span class="font-weight-bold ">{{$invoice->remaining_price}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.monthly_installment') </span>
                                <span class="font-weight-bold ">{{$invoice->monthly_installment}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.monthly_profit_percent') </span>
                                <span class="font-weight-bold ">{{$invoice->monthly_profit_percent}} %</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.profit') </span>
                                <span class="font-weight-bold ">{{$invoice->profit}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2 text-danger">
                                <span class="font-weight-bold mr-2">@lang('lang.remaining_price') </span>
                                <span class="font-weight-bold "
                                      id="sum_remaining_amount">{{$sum_remaining_amount}}</span>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div>

                            @if(!$invoice->customer->is_late)
                                @can('update-customer')
                                    <form action="{{route('customers.addToLateCustomersList',$invoice->customer->id)}}"
                                          method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            @lang('lang.add_to_late_customers_list')
                                        </button>
                                    </form>
                                @endcan
                            @endif

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.customer_name') </span>
                                <span class="font-weight-bold ">{{$invoice->customer->name}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.phone') </span>
                                <span class="font-weight-bold ">{{$invoice->customer->phone}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.phone2') </span>
                                <span class="font-weight-bold ">{{$invoice->customer->phone2}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.phone3') </span>
                                <span class="font-weight-bold ">{{$invoice->customer->phone3}}</span>
                            </div>


                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.id_number') </span>
                                <span class="font-weight-bold ">{{$invoice->customer->id_number}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.address_id') </span>
                                <span class="font-weight-bold ">{{$invoice->customer->address_id}}</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.governorate') </span>
                                <span class="font-weight-bold ">{{$invoice->customer->governorate}}</span>
                            </div>


                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.center') </span>
                                <span class="font-weight-bold ">{{$invoice->customer->center}}</span>
                            </div>


                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">@lang('lang.note') </span>
                                <span class="font-weight-bold ">{{$invoice->customer->note}}</span>
                            </div>


                            @if($invoice->invoice_type ==\App\Enums\InvoiceTypeEnum::INSURANCE->value)
                                <div class="d-flex align-items-center justify-content-between mb-2  ">

                                    <span class="font-weight-bold mr-2">@lang('lang.customer') </span>
                                    <span class="font-weight-bold ">{{$invoice->customer->name}}</span>
                                    <a class="font-weight-bold text-info "
                                       target="_blank"
                                       href="{{route('invoice.print',$invoice->customer->id)}}">@lang('lang.print')</a>

                                </div>
                                @foreach($invoice->guarantors as $guarantor)
                                    <div class="d-flex align-items-center justify-content-between mb-2  ">
                                        <span class="font-weight-bold mr-2">@lang('lang.guarantor') </span>
                                        <span class="font-weight-bold ">{{$guarantor->name}}</span>
                                        <a class="font-weight-bold text-info "
                                           target="_blank"
                                           href="{{route('invoice.print',$invoice->customer->id)}}">@lang('lang.print')</a>
                                    </div>
                                @endforeach
                            @endif


                            @if($invoice->invoice_type ==\App\Enums\InvoiceTypeEnum::INVOICE->value)
                                <div class="d-flex align-items-center justify-content-between mb-2  ">

                                    <span class="font-weight-bold mr-2">@lang('lang.customer') </span>
                                    <span class="font-weight-bold ">{{$invoice->customer->name}}</span>
                                    <a class="font-weight-bold text-info "
                                       target="_blank"
                                       href="{{route('invoice.print',$invoice->customer->id)}}">@lang('lang.print')</a>
                                </div>
                                @foreach($invoice->invoice->guarantors as $guarantor)
                                    <div class="d-flex align-items-center justify-content-between mb-2  ">
                                        <span class="font-weight-bold mr-2">@lang('lang.guarantor') </span>
                                        <span class="font-weight-bold ">{{$guarantor->name}}</span>
                                        <a class="font-weight-bold text-info "
                                           target="_blank"
                                           href="{{route('invoice.print',$invoice->customer->id)}}">@lang('lang.print')</a>
                                    </div>
                                @endforeach
                            @endif

                            @if($invoice->invoice_type ==\App\Enums\InvoiceTypeEnum::ATTORNEY->value)
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">@lang('lang.invoice_type') </span>
                                    <span class="font-weight-bold ">@lang('lang.attorney')</span>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
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
            $('body').on('click', '.postingInstallmentButton', function (event) {
                event.preventDefault();
                let id = $(this).attr('data-id');
                let days_count = $(this).parent().parent().parent().find('.form-control').val();
                let data = new FormData();

                data.append('id', id);
                data.append('days_count', days_count);

                Swal.fire({
                    icon: 'warning',
                    title: ' ترحيل القسط ' + days_count + ' يوم ؟',
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
                    title: ' ترحيل القسط شهر ؟',
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
                                $('#InvoiceInstallments-table').DataTable().ajax.reload();

                                Swal.fire({
                                    icon: 'success',
                                    title: response.success,
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'تم'
                                })
                                $('.errors').empty();

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

