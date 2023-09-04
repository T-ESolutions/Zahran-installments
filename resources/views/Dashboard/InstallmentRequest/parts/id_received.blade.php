@can('receive_id-installment_request')
    @if(!$id_received_at)
        <form class="form">
                <div class="col-12">
                    <a class="btn btn-primary btn-hover-bg-danger" id="IR_receive_id"
                       data-action="{{route('installment_requests.change.id_received',$id)}}">
                        @lang('lang.id_received')
                    </a>
                </div>
        </form>
    @else
        <h1 class="h6 text-primary" >@lang('lang.id_received_successfully')</h1>
    @endif
@endcan
