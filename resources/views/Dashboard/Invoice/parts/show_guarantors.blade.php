@foreach($invoice->guarantors as $guarantor)
    <div class="d-flex align-items-center justify-content-between mb-2  ">
        <span class="font-weight-bold ">{{$guarantor->name}}</span>
        {{--                                    <a class="btn btn-info font-weight-bold"--}}
        {{--                                       target="_blank"--}}
        {{--                                       href="{{route('invoice.print',$invoice->customer->id)}}">@lang('lang.print')--}}
        {{--                                        <i class="fas fa-print"></i></a>--}}
    </div>
@endforeach
