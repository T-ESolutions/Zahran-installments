@php($title=trans('lang.customers'))
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

        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

    <div class="card card-custom">

        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                    <li class="nav-item">
                        <a data-toggle="modal" data-target="#importModal" class="btn btn-light-primary py-2 px-4"
                           href="javascript:void(0)"> <i class="flaticon-users-1"></i>استيراد بيانات عملاء جديده  </a>
                    </li>
                    <li class="nav-item">
                        <a class=" btn btn-light-success  py-2 px-4"
                           href="{{url('/').'/template/customers_template.xlsx'}}" download="نموذج بيانات العملاء"> <i
                                class="fa fa-download"> </i> تحميل النموذج</a>
                    </li>

                </ul>
            </h3>
            <div class="card-toolbar">
                @can('create-customer')
                    <a href="{{route('customers.create')}}"
                       class="btn btn-sm btn-light-primary font-weight-bolder mr-2">
                        <i class="fa fa-plus"></i>{{trans('lang.create')}}</a>
                @endcan

                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-info font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Text\Filter.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                  فلتر

                        </button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">اختر :</li>
                                <li class="navi-item">
                                    <a href="{{route('customers.laws')}}" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-user"></i>
																</span>
                                        <span class="navi-text">المرفوع عليهم قواضي </span>
                                    </a>
                                </li>

                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
            </div>
        </div>
        {{--            <div class="card-header">--}}
        {{--                --}}


        {{--                    <h3 class="card-title align-items-start flex-column">--}}
        {{--                        <span class="card-label font-weight-bolder text-dark">New Arrivals</span>--}}
        {{--                        <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>--}}
        {{--                    </h3>--}}
        {{--            </div>--}}

        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
    <div class="modal fade" id="importModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة بيانات العملاء من ملف اكسل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form action="{{route('customers.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row">
                        <div class="form-group col-12 ">
                            <label>ملف العملاء الجدد</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" name="file_excel"  class="custom-file-input" id="customFile" />
                                <label class="custom-file-label" for="customFile">برجاء اختيار ملف امتداده .xlsx</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="testTest" class="btn btn-light-primary font-weight-bold "
                                data-dismiss="modal">@lang('lang.cancel')</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">استيراد</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@push('scripts')

    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(document).ready(function () {

            // Add the CSRF token to all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '#Customer_delete', function (event) {
                event.preventDefault();
                var url = $(this).attr('data-action');
                Swal.fire({
                    icon: 'warning',
                    title: 'هل انت متاكد من حذف هذا العنصر ؟',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا, الغاء'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'delete',
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (response) {
                                if (response.success) {
                                    $('#Customer-table').DataTable().ajax.reload();
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.success,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.error,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                }
                            },
                            error: function (response) {

                            }
                        });
                    }
                });

            })
        });

        $(document).ready(function () {

            // Add the CSRF token to all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '#customer_activation', function (event) {
                event.preventDefault();
                var url = $(this).attr('data-action');
                Swal.fire({
                    icon: 'warning',
                    title: 'هل انت متاكد من اضافه/حذف الي القائمه السوداء ؟',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا, الغاء'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'post',
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (response) {
                                if (response.success) {
                                    $('#Customer-table').DataTable().ajax.reload();
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.success,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.error,
                                        showDenyButton: false,
                                        showCancelButton: false,
                                        confirmButtonText: 'تم'
                                    })
                                }
                            },
                            error: function (response) {

                            }
                        });
                    }
                });

            })
        });

    </script>




@endpush

