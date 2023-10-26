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
            'logo' => 'nullable|mimes:jpeg,jpg,png',
            'logo_login' => 'nullable|mimes:jpeg,jpg,png',
            'monthly_profit_percent' => 'required|numeric|min:1|max:100',
            'discount_percentage' => 'required|numeric|min:1|max:100',

            'first_name' => 'required|string|max:191',
            'second_name' => 'required|string|max:191',
            'third_name' => 'required|string|max:191',
            'fourth_name' => 'required|string|max:191',
        ];
    }
}
