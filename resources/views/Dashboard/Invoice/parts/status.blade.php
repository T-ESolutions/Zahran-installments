
@if($status == 3)
    <span class="label label-xl label-success label-inline mr-2">{{trans('lang.invoice_status_'.$status)}}
</span>
    @elseif($status == 4)
        <span class="label label-xl label-danger label-inline mr-2">{{trans('lang.invoice_status_'.$status)}}
</span>
@else
    {{trans('lang.invoice_status_'.$status)}}

@endif
