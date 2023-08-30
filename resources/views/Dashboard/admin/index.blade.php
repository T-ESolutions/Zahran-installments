@php($title=trans('lang.admins'))
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
            @can('create-admins')
            <a href="{{route('admins.create')}}" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">
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
    <script type="text/javascript">
        $(document).ready(function () {

            // Add the CSRF token to all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '#admin_activation', function (event) {
                event.preventDefault();
                var url = $(this).attr('data-action');
                Swal.fire({
                    icon: 'warning',
                    title: 'هل انت متاكد من تعديل فاعليه هذا العنصر ؟',
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
                                    $('#admin-table').DataTable().ajax.reload();
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


