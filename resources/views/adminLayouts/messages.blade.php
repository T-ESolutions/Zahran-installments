@if(Session::has('success'))

    <div class="alert alert-custom alert-outline-success text-center fade show mb-5 bg-white" role="alert">
        <div class="alert-icon">
            <i class="flaticon2-checkmark"></i>
        </div>
        <div class="alert-text h6">  {{ Session('success') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
																	<span aria-hidden="true">
																		<i class="ki ki-close"></i>
																	</span>
            </button>
        </div>
    </div>

    @php(Session::forget('success'))

@endif

@if(Session::has('danger'))

    <div class="alert alert-custom alert-outline-danger text-center fade show mb-5 bg-white" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text h6">  {{ Session('danger') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
																	<span aria-hidden="true">
																		<i class="ki ki-close"></i>
																	</span>
            </button>
        </div>
    </div>

    @php(Session::forget('danger'))

@endif
