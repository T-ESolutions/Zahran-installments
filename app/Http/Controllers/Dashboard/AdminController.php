<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\AdminDataTable;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\InvoiceInstallments;
use App\Models\InvoiceInstallmentsHistory;
use App\Models\LawSuitHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminController extends GeneralController
{
    protected $viewPath = 'admin.';
    protected $path = 'admins';
    private $route = 'admins';

    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }


    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('Dashboard.admin.index');
    }

    public function history($id)
    {
        $installments = InvoiceInstallmentsHistory::where('admin_id', $id)->orderBy('created_at', 'asc')->paginate(10);
        $customers = Customer::where('admin_id', $id)->orderBy('created_at', 'asc')->paginate(10);
        $law = LawSuitHistory::where('admin_id', $id)->orderBy('created_at', 'asc')->paginate(10);
        return view($this->viewPath($this->viewPath . 'history'), compact('installments', 'law', 'customers'));

    }


    private function roles()
    {
        return Role::get();
    }

    public function create()
    {
        // Get Roles
        $roles = $this->roles();
        return view($this->viewPath($this->viewPath . 'create'), compact('roles'));
    }

    public function store(AdminRequest $request)
    {

        // Get data from request
        $inputs = $request->validated();
        // Store Data in DB
        if ($request->hasFile('image')) {
            $inputs['image'] = $this->uploadImage($request->file('image'), $this->path, null, settings('images_size'));
        }

        DB::beginTransaction();
        $inputs['admin_id'] = auth()->user()->id;

        $admin = $this->model->create($inputs);
        // Assign Roles
        $admin->assignRole($request->input('role_id'));
        DB::commit();
        return redirect()->route($this->route)->with('success', trans('lang.created'));

    }


    public function edit($id)
    {
        // Get and Check Data
        $data = $this->model->findorfail($id);
        // Get Roles
        $roles = $this->roles();
        return view($this->viewPath($this->viewPath . 'edit'), compact('data', 'roles'));
    }


    public function update(AdminRequest $request, $id)
    {
        // Get and Check Data
        $data = $this->model->findOrfail($id);
        // Get data from request
        $inputs = $request->validated();
        // Set Password if exist inputs data
        if (!empty($request->input('password'))) {
//            $inputs['password'] = bcrypt($request->input('password'));
        } else {
            unset($inputs['password']);
        }
        DB::beginTransaction();


        if ($request->hasFile('image')) {
            $inputs['image'] = $this->uploadImage($request->file('image'), $this->path, $data->image, settings('images_size'));
        }

        $data->update($inputs);
        // Assign Roles
        DB::table('model_has_roles')->where('model_id', $id)->update(['role_id' => $request['role_id']]);
        DB::commit();
        return redirect()->route($this->route)->with('success', trans('lang.updated'));

    }


    public function delete($id)
    {
        // Get and Check Data
        $data = $this->model->findOrfail($id);
        // Check If User Delete Yourself
        if (($data->id == 1)) {
            return redirect()->route($this->route)->with('danger', 'لا يمكن حذف مدير الموقع');
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        // Delete Data from DB
        $data->delete();
        return redirect()->route($this->route)->with('success', trans('lang.deleted'));

    }

    public function changeActivation(Admin $admin)
    {
        try {
            DB::beginTransaction();
            if (!$admin->id == 1) {
                $admin->update(['is_active' => !$admin->is_active]);
            }
            DB::commit();
            return response()->json(['success' => trans('lang.updated')]);
        } catch (\Exception $e) {
            info($e->getMessage());
            DB::rollback();
            return response()->json(['error' => trans('lang.wrong')]);
        }
    }


}
