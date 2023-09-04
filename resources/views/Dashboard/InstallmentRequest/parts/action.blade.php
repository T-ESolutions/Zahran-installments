@if(!$id_received_at)
    @can('update-installment_request')
        <a href="{{route('installment_requests.edit',$id)}}" title="@lang('lang.update')"
           class="btn btn-icon btn-light-primary btn-circle mr-2">
            <i class="flaticon-edit"></i>
        </a>
    @endcan

    @can('delete-installment_request')
        <a id="InstallmentRequest_delete" data-action="{{route('installment_requests.destroy',$id)}}"
           title="@lang('lang.delete')"
           class="btn btn-icon btn-light-danger btn-circle mr-2">
            <i class="flaticon2-rubbish-bin-delete-button"></i>
        </a>
    @endcan
@endif
