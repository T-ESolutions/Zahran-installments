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
            'logo' => 'nullable|mimes:jpeg,jpg,png',
            'logo_login' => 'nullable|mimes:jpeg,jpg,png',
            'copyright' => 'required|string|max:191',
            'monthly_profit_percent' => 'required|numeric|min:1|max:100',

        ];
    }
}
