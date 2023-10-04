@php($title=trans('lang.installment_requests'))
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

    <div class="card">
        <div class="text-right">
        <div class="card-header">
            @can('create-installment_request')
            <a href="{{route('installment_requests.create')}}" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">
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

           $('body').on('click', '#InstallmentRequest_delete', function (event) {
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
                                   $('#InstallmentRequest-table').DataTable().ajax.reload();
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

           $('body').on('click', '#IR_receive_id', function (event) {
               event.preventDefault();
               var url = $(this).attr('data-action');
               Swal.fire({
                   icon: 'warning',
                   title: 'هل انت متاكد من استلام البطاقه ؟',
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
                                   $('#InstallmentRequest-table').DataTable().ajax.reload();
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

           $('body').on('click', '#IR_accept', function (event) {
               event.preventDefault();
               var url = $(this).attr('data-action');
               Swal.fire({
                   icon: 'warning',
                   title: 'هل انت متاكد من الموافقه علي الطلب ؟',
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
                                   $('#InstallmentRequest-table').DataTable().ajax.reload();
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

           $('body').on('click', '#IR_reject', function (event) {
               event.preventDefault();
               var url = $(this).attr('data-action');
               Swal.fire({
                   icon: 'warning',
                   title: 'هل انت متاكد من رفض الطلب ؟',
                   showDenyButton: false,
                   showCancelButton: true,
                   confirmButtonText: 'نعم',
                   cancelButtonText: 'نعم اواافق و اضافه العميل الي القائمه السوداء'
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
                                   $('#InstallmentRequest-table').DataTable().ajax.reload();
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
                   if (result.isDismissed) {
                       var formData = new FormData();
                       formData.append('add_to_black_list', true);
                        $.ajax({
                           url: url,
                           method: 'post',
                           dataType: 'JSON',
                           contentType: false,
                           cache: false,
                           processData: false,
                            data: formData,
                           success: function (response) {
                               if (response.success) {
                                   $('#InstallmentRequest-table').DataTable().ajax.reload();
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

