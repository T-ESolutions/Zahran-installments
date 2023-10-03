@can('receive_id-installment_request')
    @if($status == \App\Enums\IRStatusEnum::PENDING->value)
        <div class="row">
            <form class="form col-12 m-2">

                <a class="btn btn-primary" id="IR_accept"
                   data-action="{{route('installment_requests.accept',$id)}}">
                    @lang('lang.approved')
                </a>
            </form>

            <form class="form col-12 m-2">
                <a class="btn btn-danger" id="IR_reject"
                   data-action="{{route('installment_requests.reject',$id)}}">
                    @lang('lang.rejected')
                </a>
            </form>
        </div>
    @elseif($status == \App\Enums\IRStatusEnum::APPROVED->value)
      <h1 class="h6 text-primary " > {{\App\Enums\IRStatusEnum::getStatusText($status)}}</h1>
    @elseif($status == \App\Enums\IRStatusEnum::REJECTED->value)
        <h1 class="h6 text-danger " > {{\App\Enums\IRStatusEnum::getStatusText($status)}}</h1>
    @endif
@endcan
