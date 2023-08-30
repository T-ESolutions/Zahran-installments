@if(Session::has('success'))
    <div class="alert alert-success text-center mr-2 h6" role="alert">
        {{ Session('success') }}
    </div>
    @php(Session::forget('success'))
@endif
@if(Session::has('danger'))
    <div class="alert alert-danger text-center mr-2 h6" role="alert">
        {{ Session('danger') }}
    </div>
    @php(Session::forget('danger'))
@endif
