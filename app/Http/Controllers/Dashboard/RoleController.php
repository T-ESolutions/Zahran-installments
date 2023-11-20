<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\RoleDataTable;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\RoleRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends GeneralController
{
    protected $viewPath = 'role';
    protected $path = 'role';
    private $route = 'roles';
    protected $paginate = 30;
    private $image_path = 'roles';


    public function __construct(Role $model)
    {
         parent::__construct($model);
    }

    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('Dashboard.' . $this->viewPath . '.index');
    }

    public function create()
    {
        // Get Permissions
        $permissions = Permission::select('path')->groupBy('path')->orderBy('path','asc')->get();
        return view('Dashboard.' . $this->viewPath . '.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $role_data['slug'] = Str::slug($request->name);
        $role_data['display_name'] = $request->name;
        $role_data['name'] = $request->name;
        $role = Role::create($role_data);
        $role->syncPermissions($request->permissions);
        return redirect()->route($this->route)->with('success', trans('lang.created'));
    }

    public function edit($id)
    {
        // Get and Check Data
        $role = Role::findOrFail($id);
        // Get Permissions
        $permissions = Permission::select('path')->groupBy('path')->get();
        // Get Old Assigned Permissions
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('Dashboard.' . $this->viewPath . '.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(RoleRequest $request, $id)
    {
        //update role data
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->slug = Str::slug($request->input('name'));
        $role->save();
        //assign new permissions
        $role->syncPermissions($request->input('permissions'));
        return redirect()->route($this->route)->with('success', trans('lang.updated'));
    }

    public function delete(Request $request, $id)
    {
        $admin=Admin::where('role_id',$id)->first();
        if ($admin)
        {
            return redirect()->back()->with('danger', trans('lang.cant_delete'));

        }
        $data = $this->model::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', trans('lang.deleted'));
    }

}
