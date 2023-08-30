<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\CaloriesCounterModuleTypeEnum;
use App\Enums\CaloriesCounterTypeEnum;
use App\Enums\PlanTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CaloriesCounterCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
         if($this->type)
        {
            if ($this->type == CaloriesCounterTypeEnum::QUESTIONS->value)
            $this->merge([
                'options_ids' => null,
            ]);

            if ($this->type == CaloriesCounterTypeEnum::OPTIONS->value)
            $this->merge([
                'questions_ids' => null,
            ]);
        }
    }

    public function rules()
    {
        $validation = [
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'image' => ['nullable','mimes:jpeg,jpg,png',  Rule::requiredIf(function() {  return Request::routeIs('calories_counter.store');})],
            'type' => ['required', Rule::in([CaloriesCounterTypeEnum::OPTIONS->value, CaloriesCounterTypeEnum::QUESTIONS->value])],
            'module_type' => ['required', Rule::in([CaloriesCounterModuleTypeEnum::HELP->value, CaloriesCounterModuleTypeEnum::CALC_CALORIES->value])],

            'questions_ids'=>'nullable|array',
            'questions_ids.*'=>['nullable',Rule::requiredIf($this->type == CaloriesCounterTypeEnum::QUESTIONS->value)],

            'options_ids'=>'nullable|array',
            'options_ids.*'=>['nullable',Rule::requiredIf($this->type == CaloriesCounterTypeEnum::OPTIONS->value)],
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
