<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\BlockEnum;
use App\Exports\CustomerLawExport;
use App\Exports\CustomersLateListExport;
use App\Exports\MonthInstallmentsExport;
use App\Http\Requests\Dashboard\CustomerCreateRequest;
use App\DataTables\Dashboard\CustomerDataTable;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\CustomerImportRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomerImport;

class CustomerController extends GeneralController
{
    protected $viewPath = 'Customer';
    protected $path = 'customer';
    private $route = 'customers.index';

    public function __construct(Customer $model)
    {
        parent::__construct($model);
        $this->middleware('permission:read-customer', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-customer', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-customer', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-customer', ['only' => ['delete']]);
    }


    public function import(CustomerImportRequest $request)
    {
        $data = $request->validated();
        if (is_file($data['file_excel'])) {
            $file_name = 'excel_' . time() . rand(0000, 9999) . '.' . $data['file_excel']->getClientOriginalExtension();
            $data['file_excel']->move(public_path('/uploads/excel/'), $file_name);
        }
//        '/uploads/excel/'.$file_name
        Excel::import(new CustomerImport(), 'uploads/excel/'.$file_name);

//        (new CustomerImport())->import('customers.xlsx', null, \Maatwebsite\Excel\Excel::XLSX);
        return redirect()->back()->with('success', 'تم الاستيراد بنجاح');
    }

    public function blackList(Request $request, CustomerDataTable $dataTable)
    {
        $request->merge(['blocked' => BlockEnum::BLOCKED->value]);
        return $dataTable->render('Dashboard.Customer.blackList');
    }

    public function lateList(Request $request, CustomerDataTable $dataTable)
    {
        $request->merge(['late' => BlockEnum::BLOCKED->value]);
        return $dataTable->render('Dashboard.Customer.lateList');
    }


    public function exportLateList(){
        return Excel::download(new CustomersLateListExport(), 'العملاء المتأخرين.xlsx');
    }

    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('Dashboard.Customer.index');
    }

    public function lawsCustomers(Request $request, CustomerDataTable $dataTable)
    {
        $request->merge(['law' => 1]);
        return $dataTable->render('Dashboard.Customer.laws');
    }



    public function exportCustomersLaw(){
        return Excel::download(new CustomerLawExport(), 'العملاء المرفوع عليهم قواضي.xlsx');
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
            if ($request->hasFile('id_image')) {
                $data['id_image'] = $this->uploadImage($request->file('id_image'), $this->path, null, settings('images_size'));
            }
            $customer = Customer::create($data);
            if (isset($data['relatives'])) {
                $customer->relatives()->createMany($data['relatives']);
            }
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

    public function show(Customer $customer)
    {
        $data = $customer->load('relatives', 'invoices.unInstallments');

        return view('Dashboard.Customer.show', compact('data'));
    }

    public function update(CustomerCreateRequest $request, Customer $customer)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            if ($request->hasFile('id_image')) {
                $data['id_image'] = $this->uploadImage($request->file('id_image'), $this->path, $data['id_image'], settings('images_size'));
            }
            $customer->update($data);

            if (isset($data['relatives'])) {
                $customer->relatives()->delete();
                $customer->relatives()->createMany($data['relatives']);
            }
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

    public function changeActivation(Request $request, Customer $customer)
    {
        $customer->is_blocked = !$customer->is_blocked;
        $customer->save();
        return response()->json(['success' => trans('lang.updated')]);

    }

    public function addToLateCustomersList(Customer $customer)
    {
        $customer->is_late = !$customer->is_late;
        $customer->save();
        return back()->with('success', trans('lang.updated'));


    }
}
