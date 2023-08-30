<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
   public function index()
   {
       return view('Dashboard.profile');
   }
   public function update( ProfileUpdateRequest $request )
   {

       $data = $request->validated();
       $data = Arr::except($data,['password_confirmation']);
         if ($data['password'] == null)
         {
             $data = Arr::except($data,['password']);
         }

       Admin::where('id',auth()->user()->id)->update($data);
       return redirect()->route('dashboard')->with('success', trans('lang.updated'));
   }
}
