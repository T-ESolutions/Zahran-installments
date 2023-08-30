<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\PlanTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChoiceCreateRequest extends FormRequest
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
            'type' => ['required', Rule::in([PlanTypeEnum::PLAN->value, PlanTypeEnum::QUESTION->value])],
            'plan_id' => ['required', 'exists:plans,id'],
            'image' => ['nullable','mimes:jpeg,jpg,png',  Rule::requiredIf(function() {  return Request::routeIs('plans.store');})],

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
