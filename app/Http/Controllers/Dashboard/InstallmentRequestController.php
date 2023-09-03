<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\InstallmentRequestCreateRequest;
use App\DataTables\Dashboard\InstallmentRequestDataTable;
use App\Models\Customer;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\GeneralController;
use App\Models\InstallmentRequest;
use Illuminate\Support\Facades\DB;


class InstallmentRequestController extends GeneralController
{

       protected $viewPath = 'InstallmentRequest';
       protected $path = 'installmentRequest';
       private $route = 'installment_requests.index';

    public function __construct(InstallmentRequest $model)
    {
        parent::__construct($model);
        $this->middleware('permission:read-installment_request', ['only' => ['index']]);
        $this->middleware('permission:create-installment_request', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-installment_request', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-installment_request', ['only' => ['delete']]);
    }

    public function index(InstallmentRequestDataTable $dataTable)
    {
        $customers = Customer::get(['id','name']);
        return $dataTable->render('Dashboard.InstallmentRequest.index');
    }

   public function create()
    {
        $customers = Customer::get(['id','name']);
        return view('Dashboard.InstallmentRequest.create',compact('customers'));
    }

    public function store(InstallmentRequestCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['admin_id'] = auth()->user()->id;
            $installmentRequest= $this->model::create($data);
            if ($request->customers_ids) {
                $installmentRequest->customers()->attach($request->customers_ids);
            }
            DB::commit();
            return redirect()->route($this->route)->with('success', trans('lang.created'));
        } catch (\Exception $e) {
            info($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

     public function edit(InstallmentRequest $installmentRequest)
     {
         $data = $installmentRequest->load('customers');
          $customers= Customer::get(['id','name']);
         return view('Dashboard.InstallmentRequest.edit', compact('data','customers'));
     }

    public function update(InstallmentRequestCreateRequest $request,InstallmentRequest $installmentRequest)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage($request->file('image'), $this->path, null, settings('images_size'));
            }
            $installmentRequest->update($data);
            DB::commit();
            return redirect()->route($this->route)->with('success', trans('lang.updated'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

  public function destroy(Request $request,InstallmentRequest $installmentRequest)
  {
      try {
       DB::beginTransaction();
          $data = $installmentRequest;

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
