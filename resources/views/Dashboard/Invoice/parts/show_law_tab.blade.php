<div class="scroll pr-7 mr-n7 ps ps--active-y" data-scroll="true" data-height="400"
     data-mobile-height="200" style="height: 400px; overflow: hidden;">
    <div class="table-responsive">
        <table
            class="table table-head-custom table-head-bg table-borderless table-vertical-center">
            <thead>
            <tr>
                <th class="pl-7 text-left ">رقم القضية</th>
                <th class="pl-7 text-left ">النوع</th>
                <th class="p-0 min-w-125px text-center">اسم المصروف</th>
                <th class="p-0 min-w-125px text-center">الوصف</th>
                <th class="p-0 min-w-125px text-center">انشء بواسطة</th>
                <th class="p-0 min-w-125px text-center">المبلغ</th>
                <th class="p-0 min-w-100px text-center">المبلغ المدفوع</th>
                <th class="p-0 min-w-110px text-center">الحالة</th>
            </tr>
            </thead>
            <tbody>
            @if(count($invoice->lawSuit) == 0)
                <tr>
                    <td class="text-center" colspan="10">
                        <h4 class="text-danger">لا يوجد مصاريف قضائية </h4>
                    </td>
                </tr>
            @endif
            @foreach($invoice->lawSuit as $row)
                <tr>
                    <td class="pl-0 py-4">
                        <div class="symbol symbol-50 symbol-light-danger">
                            <span class="font-size-h3 symbol-label font-weight-boldest"
                                  title="رقم الفاتورة">
                            {{$row->id}}
                            </span>
                        </div>
                    </td>
                    <td class="text-center">
                                                <span
                                                    class="label label-lg label-light-info label-inline">{{($row->type == 1)? 'انذار' : 'قضية'}} </span>
                    </td>
                    <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->title}} </span>
                        {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                    </td>
                    <td class="text-center">
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->description}} </span>
                        {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                    </td>
                    <td class="text-center">
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->admin->name}} </span>
                        {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                    </td>
                    <td class="text-center">
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->amount}} </span>
                        {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                    </td>
                    <td class="text-center">
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->paid_amount}} </span>
                        {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                    </td>
                    <td class="text-center">
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->status}} </span>
                        {{--                                                <span class="text-muted font-weight-bold">Paid</span>--}}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
