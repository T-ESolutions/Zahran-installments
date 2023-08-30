<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class PageCreateRequest extends FormRequest
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
            'description_ar' => ['required'],
            'description_en' => ['required'],
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
