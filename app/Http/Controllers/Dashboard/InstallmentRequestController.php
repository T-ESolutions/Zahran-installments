<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\BlockEnum;
use App\Enums\IRStatusEnum;
use App\Http\Requests\Dashboard\InstallmentRequestCreateRequest;
use App\DataTables\Dashboard\InstallmentRequestDataTable;
use App\Models\Customer;
use App\Http\Controllers\GeneralController;
use App\Models\InstallmentRequest;
use Illuminate\Http\Request;
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
        $this->middleware('permission:receive_id-installment_request', ['only' => ['changeIdReceived']]);
    }

    public function index(InstallmentRequestDataTable $dataTable)
    {
        $customers = Customer::get(['id', 'name']);
        return $dataTable->render('Dashboard.InstallmentRequest.index');
    }

    public function create()
    {
        $customers = Customer::WhiteList()->get(['id', 'name']);
        return view('Dashboard.InstallmentRequest.create', compact('customers'));
    }

    public function store(InstallmentRequestCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['admin_id'] = auth()->user()->id;
            $installmentRequest = $this->model::create($data);
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
        if ($installmentRequest->id_received_at) {
            abort(404);
        }
        $data = $installmentRequest->load('customers');
        $customers = Customer::WhiteList()->get(['id', 'name']);
        return view('Dashboard.InstallmentRequest.edit', compact('data', 'customers'));
    }

    public function update(InstallmentRequestCreateRequest $request, InstallmentRequest $installmentRequest)
    {
        if ($installmentRequest->id_received_at) {
            abort(404);
        }

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

    public function destroy(Request $request, InstallmentRequest $installmentRequest)
    {
        if ($installmentRequest->id_received_at) {
            abort(404);
        }
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

    public function changeIdReceived(Request $request, InstallmentRequest $installmentRequest)
    {
        if (!$installmentRequest->id_received_at) {
            $installmentRequest->update(['id_received_at' => now()]);
        }
        return response()->json(['success' => trans('lang.updated')]);
    }

    public function accept(Request $request, InstallmentRequest $installmentRequest)
    {
        if ($installmentRequest->status == IRStatusEnum::PENDING->value) {
            $installmentRequest->update(['status' => IRStatusEnum::APPROVED->value]);
        }
        return response()->json(['success' => trans('lang.updated')]);
    }

    public function reject(Request $request, InstallmentRequest $installmentRequest)
    {

        if ($installmentRequest->status == IRStatusEnum::PENDING->value) {
            $installmentRequest->update(['status' => IRStatusEnum::REJECTED->value]);
        }

        if ($request->add_to_black_list) {

            $installmentRequest->customer->update(
                ['is_blocked' => BlockEnum::BLOCKED->value]
            );
        }


        return response()->json(['success' => trans('lang.updated')]);
    }
}
