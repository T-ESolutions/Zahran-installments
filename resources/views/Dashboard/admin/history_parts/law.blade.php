{{--<div class="scroll pr-7 mr-n7 ps ps--active-y" data-scroll="true" data-height="400"--}}
{{--     data-mobile-height="200" style="height: 400px; overflow: hidden;">--}}
<div class="table-responsive">
    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
        <thead>
        <tr>
            <th class="pl-7 text-left ">رقم المصروف القضائي</th>
            <th class="p-0 min-w-125px text-center">الوصف</th>
            <th class="p-0 min-w-150px text-center">أنشئت في</th>
        </tr>
        </thead>
        <tbody>
        @if(count($law) == 0)
            <tr>
                <td class="text-center" colspan="10">
                    <h4 class="text-danger">لا يوجد تحركات في القضايا والانذارات </h4>
                </td>
            </tr>
        @endif
        @foreach($law as $row)
            <tr>
                <td class="pl-0 py-4">
                    <div class="symbol symbol-50 symbol-light-danger">
                        <span class="font-size-h3 symbol-label font-weight-boldest"
                              title="رقم المصروف القضائي">
                        {{$row->lawsuit_id}}
                        </span>
                    </div>
                </td>
                <td class="text-center">
                <span
                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->description}} </span>
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
{{$law->links()}}
