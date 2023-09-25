@can('read-invoice')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postingInstallment{{$id}}">
        @lang('lang.posting_installment')
    </button>

    <!-- Modal-->
    <div class="modal fade" id="postingInstallment{{$id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('lang.days_count')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group  col-12">
                            <label>{{trans('lang.days_count')}}<span
                                    class="text-danger">*</span></label>
                            <input name="days_count" placeholder="{{trans('lang.days_count')}}"

                                   class="form-control" type="number"
                                   maxlength="255"/>

                            <span class="text-danger errors form_error_days_count" role="alert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button{{$id}}" id="testTest" class="btn btn-light-primary font-weight-bold " data-dismiss="modal">@lang('lang.cancel')</button>
                        <button type="button" class="btn btn-primary font-weight-bold postingInstallmentButton" data-id="{{$id}}" >@lang('lang.save')</button>
                    </div>

            </div>
        </div>
    </div>
@endcan


