@can('update-lawsuit')
<a href="{{route('lawsuits.edit',$id)}}" title="@lang('lang.update')" class="btn btn-icon btn-light-primary btn-circle mr-2">
    <i class="flaticon-edit"></i>
</a>
@endcan
@can('delete-lawsuit')
 <a  id="Lawsuit_delete" data-action="{{route('lawsuits.destroy',$id)}}"   title="@lang('lang.delete')"
   class="btn btn-icon btn-light-danger btn-circle mr-2">
    <i class="flaticon2-rubbish-bin-delete-button"></i>
</a>
@endcan
