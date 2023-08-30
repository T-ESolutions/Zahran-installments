
@if($id!=1)
@can('update-roles')
<a href="{{route('roles.edit',$id)}}" title="@lang('lang.update')" class="btn btn-icon btn-light-primary btn-circle mr-2">
    <i class="flaticon-edit"></i>
</a>
@endcan

@can('delete-roles')
<a href="{{route('roles.delete',$id)}}" onclick=" return confirm('هل متاكد من الحذف ؟ ')" class="btn btn-icon btn-light-danger btn-circle mr-2">
    <i class="flaticon2-rubbish-bin-delete-button"></i>
</a>
@endcan
@endif
