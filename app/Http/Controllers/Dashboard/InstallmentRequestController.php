<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\InstallmentRequestCreateRequest;
use App\DataTables\Dashboard\InstallmentRequestDataTable;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\GeneralController;
use App\Models\InstallmentRequest;
use Illuminate\Support\Facades\DB;


class InstallmentRequestController extends GeneralController
{

     /*  Cut this in Translations

     'installment_requests'=>'',
     'installment_request'=>'',
     'read-installment_request'=>'',
     'create-installment_request'=>'',
     'edit-installment_request'=>'',
     'update-installment_request'=>'',
     'delete-installment_request'=>'',

     */

       protected $viewPath = 'InstallmentRequest';
       protected $path = 'installmentRequest';
       private $route = 'installmentrequests.index';

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
        return $dataTable->render('Dashboard.InstallmentRequest.index');
    }

   public function create()
    {
        return view('Dashboard.InstallmentRequest.create');
    }

    public function store(InstallmentRequestCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage($request->file('image'), $this->path, null, settings('images_size'));
            }
            $this->model::create($data);
            DB::commit();
            return redirect()->route($this->route)->with('success', trans('lang.created'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

     public function edit(InstallmentRequest $installmentRequest)
     {
         $data = $installmentRequest;
         return view('Dashboard.InstallmentRequest.edit', compact('data'));
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
