<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Admin;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    public function index()
    {
        return view('Dashboard.profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $data = Arr::except($data, ['password_confirmation']);
        if ($data['password'] == null) {
            $data = Arr::except($data, ['password']);
        }
        Admin::where('id', auth()->user()->id)->update($data);
        toast(trans('lang.updated'), 'success');
        return redirect()->route('dashboard');
    }
}
