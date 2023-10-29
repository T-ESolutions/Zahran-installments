{{--<div class="scroll pr-7 mr-n7 ps ps--active-y" data-scroll="true" data-height="400"--}}
{{--     data-mobile-height="200" style="height: 400px; overflow: hidden;">--}}
    <div class="table-responsive">
        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
            <thead>
            <tr>
                <th class="pl-7 text-left ">الفاتورة</th>
                <th class="p-0 min-w-200px">العميل</th>
                <th class="p-0 min-w-125px text-center">رقم القسط</th>
                <th class="p-0 min-w-125px text-center">الوصف</th>
                <th class="p-0 min-w-150px text-center">أنشئت في</th>
            </tr>
            </thead>
            <tbody>
            @if(count($installments) == 0)
                <tr>
                    <td class="text-center" colspan="10">
                        <h4 class="text-danger">لا يوجد تحركات في الفواتير والاقساط </h4>
                    </td>
                </tr>
            @endif
            @foreach($installments as $row)
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
                                                    class="label label-lg label-light-info label-inline">{{$row->invoice_installments_id}} </span>
                    </td>
                    <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->description}} </span>
                        {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                    </td>
                    <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->created_at}} </span>
                        {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>


    </div>
{{--</div>--}}
{{$installments->links()}}
