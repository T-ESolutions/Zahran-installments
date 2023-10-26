<div class="dropdown dropdown-inline mr-4">
    <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
        <i class="ki ki-bold-more-hor"></i>
    </button>
    <div class="dropdown-menu">
        @can('read-invoice')
            <a class="dropdown-item" data-toggle="modal" data-target="#changeDateModal{{$id}}"
               href="javascript:void(0);">@lang('lang.change_date')</a>
            <a class="dropdown-item monthPostingInstallmentButton " data-id="{{$id}}"
               href="javascript:void(0);">@lang('lang.month_posting_installment')</a>
            <a class="dropdown-item" data-toggle="modal" data-target="#postingInstallment{{$id}}"
               href="javascript:void(0);">@lang('lang.posting_installment')</a>
            <a class="dropdown-item" data-toggle="modal" data-target="#notes_model{{$id}}"
               href="javascript:void(0);">اضافة ملاحظات</a>
            <a class="dropdown-item" data-toggle="modal" data-target="#IIHistory{{$id}}"
               href="javascript:void(0);">@lang('lang.history')</a>
        @endcan

    </div>
</div>

<div class="modal fade" id="notes_model{{$id}}" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة ملاحظات</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="form-group  col-12">
                    <label>اكتب ملاحظتك هنا<span
                            class="text-danger">*</span></label>
                    <textarea name="notes"
                              class="form-control notes_txt" type="number"
                              rows="5">{{$notes}}</textarea>

                    <span class="text-danger errors form_error_days_count" role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button{{$id}}" id="testTest" class="btn btn-light-primary font-weight-bold "
                        data-dismiss="modal">@lang('lang.cancel')</button>
                <button type="button" class="btn btn-primary font-weight-bold add_notes_btn"
                        data-id="{{$id}}">@lang('lang.save')</button>
            </div>

        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="changeDateModal{{$id}}" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('lang.change_date')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="form-group  col-12">
                    <label>{{trans('lang.pay_date')}}<span
                            class="text-danger">*</span></label>
                    <input name="pay_date" placeholder="{{trans('lang.pay_date')}}"

                           class="form-control" type="date"
                           maxlength="255"/>

                    <span class="text-danger errors form_error_pay_date" role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button{{$id}}" id="testTest" class="btn btn-light-primary font-weight-bold "
                        data-dismiss="modal">@lang('lang.cancel')</button>
                <button type="button" class="btn btn-primary font-weight-bold changeDateInstallment"
                        data-id="{{$id}}">@lang('lang.save')</button>
            </div>

        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="IIHistory{{$id}}" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl " role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('lang.history')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="col-md-12">
                        <table class="datatable-table" style="width: 100%;">
                            <thead class="datatable-head">
                            <tr>
                                <th>المحتوى</th>
                                <th>المشرف</th>
                                <th>التاريخ</th>
                            </tr>
                            </thead>
                            <tbody class="datatable-body">
                            @foreach($history as $h)

                                <tr>
                                    <td>{{ $h['description']  }}</td>
                                    <td>{{ $h['admin']['name']   }}</td>
                                    <td>{{ $h['created_at']   }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="postingInstallment{{$id}}" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
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
                <button type="button{{$id}}" id="testTest" class="btn btn-light-primary font-weight-bold "
                        data-dismiss="modal">@lang('lang.cancel')</button>
                <button type="button" class="btn btn-primary font-weight-bold postingInstallmentButton"
                        data-id="{{$id}}">@lang('lang.save')</button>
            </div>

        </div>
    </div>
</div>


