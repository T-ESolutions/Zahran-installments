@php($title='المرفوع عليهم قواضي')
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
                المرفوع عليهم قواضي
            </h3>
            <div class="card-toolbar">
                    <a href="{{route('customers.export.law')}}"
                       class="btn btn-sm btn-light-primary font-weight-bolder mr-2">
                        <i class="fa fa-file-excel"></i>تصدير الى ملف اكسل</a>

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

