@can('change-activation-customers')
    @if($id != 1)
        <form class="form">
                   <span class="switch switch-outline switch-icon switch-Primary">
                    <label>
                         <input type="checkbox" id="admin_activation" data-action="{{route('admins.change.activation',$id)}}"
                                @if($is_active) checked="checked" @endif  name="select"/>
                         <span></span>
                    </label>
                   </span>
        </form>
    @endif
@endcan
@push('scripts')

@endpush
