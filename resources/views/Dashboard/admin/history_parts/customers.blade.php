{{--<div class="scroll pr-7 mr-n7 ps ps--active-y" data-scroll="true" data-height="400"--}}
{{--     data-mobile-height="200" style="height: 400px; overflow: hidden;">--}}
<div class="table-responsive">
    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
        <thead>
        <tr class="text-uppercase">
            <th style="min-width: 250px" class="pl-7 text-center ">اسم العميل</th>
            <th class="p-0 min-w-200px text-center">رقم الهاتف</th>
            <th class="p-0 min-w-150px text-center">أنشئت في</th>
        </tr>
        </thead>
        <tbody>
        @if(count($customers) == 0)
            <tr>
                <td class="text-center" colspan="10">
                    <h4 class="text-danger">لا يوجد تحركات في اضافة العملاء </h4>
                </td>
            </tr>
        @endif
        @foreach($customers as $row)
            <tr>
                <td class="text-center">
                        <span
                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->name}} </span>
                </td>
                <td class="text-center">
                    <span
                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->phone}} </span>
                </td>
                <td class="text-center">
                        <span
                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->created_at}} </span>
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>


</div>
{{--</div>--}}
{{$customers->links()}}
