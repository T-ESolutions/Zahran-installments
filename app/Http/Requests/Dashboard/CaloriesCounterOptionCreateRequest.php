<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CaloriesCounterOptionCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validation = [
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'value' => ['required', 'numeric', 'gt:0'],
            'image' => ['nullable','mimes:jpeg,jpg,png',  Rule::requiredIf(function() {  return Request::routeIs('calories_counter_option.store');})],
        ];

        return $validation;
    }

    public function attributes()
    {
        return [
            'example_input' => __('example input'),
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
