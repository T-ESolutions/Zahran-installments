@can('update-invoice')
<a href="{{route('invoices.edit',$id)}}" title="@lang('lang.update')" class="btn btn-icon btn-light-primary btn-circle mr-2">
    <i class="flaticon-edit"></i>
</a>
@endcan
@can('delete-invoice')
 <a  id="Invoice_delete" data-action="{{route('invoices.destroy',$id)}}"   title="@lang('lang.delete')"
   class="btn btn-icon btn-light-danger btn-circle mr-2">
    <i class="flaticon2-rubbish-bin-delete-button"></i>
</a>
@endcan
