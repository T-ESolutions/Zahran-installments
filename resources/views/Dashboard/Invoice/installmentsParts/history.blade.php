@can('read-invoice')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#IIHistory{{$id}}">
        @lang('lang.history')
    </button>

    <!-- Modal-->
    <div class="modal fade" id="IIHistory{{$id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('lang.history')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group  col-12">
                          @foreach($history as $h)
                               <span class="h6 mb-2 text-center"> قام {{ $h['admin']['name'] . $h['description']  }} في تاريخ  {{ $h['created_at'] }}</span> <br>
                          @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button{{$id}}" id="testTest" class="btn btn-light-primary font-weight-bold " data-dismiss="modal">@lang('lang.cancel')</button>
                     </div>

            </div>
        </div>
    </div>
@endcan


