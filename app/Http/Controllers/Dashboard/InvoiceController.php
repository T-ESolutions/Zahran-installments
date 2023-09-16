<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\InvoiceCreateRequest;
use App\DataTables\Dashboard\InvoiceDataTable;
use App\Models\Customer;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\GeneralController;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;


class InvoiceController extends GeneralController
{

       protected $viewPath = 'Invoice';
       protected $path = 'invoice';
       private $route = 'invoices.index';

    public function __construct(Invoice $model)
    {
        parent::__construct($model);
        $this->middleware('permission:read-invoice', ['only' => ['index']]);
        $this->middleware('permission:create-invoice', ['only' => ['create', 'store']]);
    }

    public function index(InvoiceDataTable $dataTable)
    {
        return $dataTable->render('Dashboard.Invoice.index');
    }

   public function create()
    {
        $monthly_profit_percent = settings('monthly_profit_percent');
        $customers = Customer::WhiteList()->get(['id', 'name']);
        return view('Dashboard.Invoice.create',compact('monthly_profit_percent','customers'));
    }

    public function store(InvoiceCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['admin_id'] = auth()->user()->id;
             $invoice= $this->model::create($data);
             DB::commit();
            return redirect()->route($this->route)->with('success', trans('lang.created'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

/*     public function edit(Invoice $invoice)
     {
         $data = $invoice;
         return view('Dashboard.Invoice.edit', compact('data'));
     }

    public function update(InvoiceCreateRequest $request,Invoice $invoice)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage($request->file('image'), $this->path, null, settings('images_size'));
            }
            $invoice->update($data);
            DB::commit();
            return redirect()->route($this->route)->with('success', trans('lang.updated'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', trans('lang.wrong'));
        }
    }

  public function destroy(Request $request,Invoice $invoice)
  {
      try {
       DB::beginTransaction();
          $data = $invoice;

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
  }*/
}
