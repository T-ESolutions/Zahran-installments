<div class="row">
    @csrf
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group  col-12">
                    <label>
                        {{trans('lang.name')}}
                        <span class="text-danger">*</span>
                    </label>
                    <input name="name" id="name" placeholder="{{trans('lang.name')}}" value="{{ old('name', $role->name ?? '') }}"
                           class="form-control  {{ $errors->has('name') ? 'border-danger' : '' }}" type="text"
                           maxlength="255"/>
                    @if($errors->has('name'))
                        <span  class="text-danger m-2 ">{{ $errors->first('name') }}</span>
                    @endif

                </div>
            </div>
        </div>
        <br>
        <br>
    </div>
</div>
@if($errors->has('permissions'))
    <span  class="text-danger m-2 ">{{ $errors->first('permissions') }}</span>
@endif
<div class="row">

    @foreach($permissions as $row)
        @php $group_permissions = \Spatie\Permission\Models\Permission::where('path',$row->path)->get(); @endphp
        <div class="col-lg-4 col-sm-6 mb-3">
            <div class="card card-outline-primary h-100">
                <div class="card-header">
                    <h5 class="">{{trans("lang.".$row->path)}}</h5>
                </div>
                <br>
                <div class="card-body  {{ $errors->has('permissions') ? 'border-danger' : '' }}">
                    <div class="form-group row">


                            @foreach($group_permissions as $permission)
                                <label class="col-md-8 col-from-label" for="banner">{{ trans('lang.'.$permission->name) }}</label>
                            <div class="col-md-4">
                                <div class="row align-items-center  gap-3 mb-3">
{{--                                    <label class="col-from-label text-capitalize col-md-8"></label>--}}
                                    <span class="switch switch-outline switch-icon swibtn-success mx-3">
                                        <label>

                                            <input type="checkbo " value="{{$permission->name}}"
                                                @if(request()->segment(4) == 'edit')   @php if(in_array($permission->id , $rolePermissions)) echo "checked"; @endphp  @endif name="permissions[]"/>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
            <br>
        </div>
    @endforeach
</div>
<div class="text-left">
    {{--    for avoid  edit admin permissions--}}

    @if(request()->segment(4) == 'edit' && $role->id == 1)
    @else
        <button type="Submit" id="submit" class="btn btn-primary btn-default ">{{trans('lang.save')}}</button>
        <a href="{{ URL::previous() }}" class="btn btn-secondary">{{trans('lang.cancel')}}</a>
    @endif
</div>
