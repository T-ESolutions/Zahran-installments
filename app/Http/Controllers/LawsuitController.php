<?php

namespace App\Http\Controllers;

use App\Http\Requests\LawsuitCreateRequest;
use App\DataTables\LawsuitDataTable;
use App\Models\Customer;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\GeneralController;
use App\Models\Lawsuit;
use Illuminate\Support\Facades\DB;


class LawsuitController extends GeneralController
{



       protected $viewPath = 'Lawsuit';
       protected $path = 'lawsuit';
       private $route = 'lawsuits.index';

    public function __construct(Lawsuit $model)
    {
        parent::__construct($model);
        $this->middleware('permission:read-lawsuit', ['only' => ['index']]);
        $this->middleware('permission:create-lawsuit', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-lawsuit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-lawsuit', ['only' => ['delete']]);
    }

    public function index(LawsuitDataTable $dataTable)
    {
        return $dataTable->render('.Lawsuit.index');
    }

   public function create()
    {
        $customers = Customer::get(['id', 'name']);
        return view('.Lawsuit.create', compact('customers'));
    }

    public function store(LawsuitCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['admin_id'] = auth()->id();
            $this->model::create($data);
             DB::commit();
            return redirect()->route($this->route)->with('success', trans('lang.created'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }



  public function destroy(Request $request,Lawsuit $lawsuit)
  {
      try {
       DB::beginTransaction();
          $data = $lawsuit;

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
