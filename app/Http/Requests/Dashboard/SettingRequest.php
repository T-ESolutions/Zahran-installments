<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'site_name_ar' => 'required|string|max:191',
            'site_name_en' => 'required|string|max:191',
            'whatsapp' => 'required|max:191|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'phone' => 'required|max:191|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|string|email|max:191',
            'logo' => 'nullable|mimes:jpeg,jpg,png',
//            'login_pg' => 'nullable|mimes:jpeg,jpg,png',
            'logo_login' => 'nullable|mimes:jpeg,jpg,png',
            'calc_calories' => 'nullable|mimes:jpeg,jpg,png',
            'contact_us' => 'nullable|mimes:jpeg,jpg,png',
//            'location' => 'nullable|url|max:191',
            'facebook' => 'nullable|url|max:191',
            'twitter' => 'nullable|url|max:191',
            'google_map' => 'required',
            'instagram' => 'nullable|url|max:191',
            'snapchat' => 'nullable|url|max:191',
//            'pinterest' => 'nullable|url|max:191',
            'youtube' => 'nullable|url|max:191',
//            'telegram' => 'nullable|url|max:191',
            'address_ar' => 'nullable|string|max:191',
            'address_en' => 'nullable|string|max:191',
//            'sm_description_ar' => 'required|string|max:191',
//            'sm_description_en' => 'required|string|max:191',
            'copyright' => 'required|string|max:191',
            'copyright_link_text_en' => 'nullable|string|max:191',
            'copyright_link_text_ar' => 'nullable|string|max:191',
//            'copyright_link' => 'nullable|url|max:191',
            'terms_ar'=>'nullable',
            'terms_en'=>'nullable',
            'privacy_ar'=>'nullable',
            'privacy_en'=>'nullable',
//            'usage_ar'=>'nullable',
//            'usage_en'=>'nullable',
            'about_ar'=>'nullable',
            'about_en'=>'nullable',
            'times_of_work'=>'nullable',
            'tax'=>'nullable|numeric|min:1',
//            'delivery_cost'=>'nullable|numeric',
//            'cash_on_delivery'=>'nullable|numeric',
        ];
    }
}
