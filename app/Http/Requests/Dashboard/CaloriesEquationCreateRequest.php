<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CaloriesEquationCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
     }

    public function rules()
    {

        $validation = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'gender' => 'required',
            'listData' => 'required',
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
