<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CustomerCreateRequest;
use App\DataTables\Dashboard\CustomerDataTable;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\GeneralController;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;


class CustomerController extends GeneralController
{
    protected $viewPath = 'Customer';
    protected $path = 'customer';
    private $route = 'customers.index';

    public function __construct(Customer $model)
    {
        parent::__construct($model);
        $this->middleware('permission:read-customer', ['only' => ['index']]);
        $this->middleware('permission:create-customer', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-customer', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-customer', ['only' => ['delete']]);
    }

    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('Dashboard.Customer.index');
    }

    public function create()
    {
        return view('Dashboard.Customer.create');
    }

    public function store(CustomerCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['admin_id'] = auth()->user()->id;
            if ($request->hasFile('id_image_back')) {
                $data['id_image_back'] = $this->uploadImage($request->file('id_image_back'), $this->path, null, settings('images_size'));
            }
            if ($request->hasFile('id_image_front')) {
                $data['id_image_front'] = $this->uploadImage($request->file('id_image_front'), $this->path, null, settings('images_size'));
            }
            $customer = $this->model::create($data);
            $customer->relatives()->createMany($data['relatives']);
            DB::commit();
            return redirect()->route($this->route)->with('success', trans('lang.created'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

    public function edit(Customer $customer)
    {
        $data = $customer;
        return view('Dashboard.Customer.edit', compact('data'));
    }

    public function update(CustomerCreateRequest $request, Customer $customer)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage($request->file('image'), $this->path, null, settings('images_size'));
            }
            $customer->update($data);
            DB::commit();
            return redirect()->route($this->route)->with('success', trans('lang.updated'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

    public function destroy(Request $request, Customer $customer)
    {
        try {
            DB::beginTransaction();
            $data = $customer;

            foreach ($data->getRelations() as $relation) {
                if ($data->$relation()->count()) {
                    return response()->json(['error' => trans('lang.wrong')]);
                }
            }

            $data->delete();
            DB::commit();
            return response()->json(['success' => trans('lang.deleted')]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => trans('lang.wrong')]);
        }
    }
}
