@can('update-admins')
    <a href="{{route('admins.edit',$id)}}" title="@lang('lang.update')"
       class="btn btn-icon btn-light-primary btn-circle mr-2">
        <i class="flaticon-edit"></i>
    </a>
@endcan
@can('delete-admins')
    @if($id != 1)
        <a href="{{route('admins.delete',$id)}}" title="@lang('lang.delete')"
           onclick=" return confirm('هل متاكد من الحذف ؟ ')"
           class="btn btn-icon btn-light-danger btn-circle mr-2">
            <i class="flaticon2-rubbish-bin-delete-button"></i>
        </a>
    @endif
@endcan
