@can('change-activation-admins')
    <form class="form">
        <div class="form-group row">
             <div class="col-3">
   <span class="switch switch-outline switch-icon switch-danger">
    <label>
     <input type="checkbox" id="customer_activation" data-action="{{route('customers.change.activation',$id)}}"  @if($is_blocked) checked="checked"  @endif  name="select"/>
     <span></span>
    </label>
   </span>
            </div>
        </div>
    </form>
@endcan
