@can('update-customer')
<a href="{{route('customers.edit',$id)}}" title="@lang('lang.update')" class="btn btn-icon btn-light-primary btn-circle mr-2">
    <i class="flaticon-edit"></i>
</a>
@endcan
@can('delete-customer')
 <a  id="Customer_delete" data-action="{{route('customers.destroy',$id)}}"   title="@lang('lang.delete')"
   class="btn btn-icon btn-light-danger btn-circle mr-2">
    <i class="flaticon2-rubbish-bin-delete-button"></i>
</a>
@endcan
