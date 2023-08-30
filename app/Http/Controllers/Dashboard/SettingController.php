<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingController extends GeneralController
{

    protected $viewPath = 'setting.';
    protected $path = 'setting';
    protected $quality = 100;
    protected $encode = 'png';


    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }


    /**
     * Get All Data Model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->model->get();
        return view($this->viewPath($this->viewPath . 'edit'), compact('data'));
    }


    public function update(SettingRequest $request)
    {

        $data = $this->model->get();
        $inputs = $request->validated();
        if($request->hasFile('logo')) {
            $inputs['logo'] = $this->uploadImage($request->file('logo'), $this->path, $data->where('key', 'logo')->first()->val,500);
        }
        if($request->hasFile('logo_login')) {
            $inputs['logo_login'] = $this->uploadImage($request->file('logo_login'), $this->path, $data->where('key', 'logo_login')->first()->val,null, 500);
        }
        if($request->hasFile('login_pg')) {
            $inputs['login_pg'] = $this->uploadImage($request->file('login_pg'), $this->path, $data->where('key', 'login_pg')->first()->val , null,90);
        }
        if($request->hasFile('contact_us')) {
            $inputs['contact_us'] = $this->uploadImage($request->file('contact_us'), $this->path, $data->where('key', 'contact_us')->first()->val , null,2048);
        }
        if($request->hasFile('calc_calories')) {
            $inputs['calc_calories'] = $this->uploadImage($request->file('calc_calories'), $this->path, $data->where('key', 'calc_calories')->first()->val , null,2048);
        }
        $this->model->setMany($inputs);
        $this->flash('success',trans('lang.updated'));
        Cache::forget('settings');
        return back();
    }
}
