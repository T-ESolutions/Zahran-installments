<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\MacrosCalculatorTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MacrosCalculatorCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function prepareForValidation()
    {
        if ($this->type) {
            if ($this->type == MacrosCalculatorTypeEnum::MAIN->value)
                $this->merge([
                    'description_ar' => null,
                    'description_en' => null,
                    'parent_id' => null,
                ]);
        }
    }

    public function rules()
    {
        $validation = [
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in([MacrosCalculatorTypeEnum::MAIN->value, MacrosCalculatorTypeEnum::CONTENT->value])],
            'parent_id' => ['nullable', Rule::requiredIf($this->type == MacrosCalculatorTypeEnum::CONTENT->value)],
/*            'description_ar' => ['nullable', Rule::requiredIf($this->type == MacrosCalculatorTypeEnum::CONTENT->value)],
            'description_en' => ['nullable', Rule::requiredIf($this->type == MacrosCalculatorTypeEnum::CONTENT->value)],*/
        ];

        return $validation;
    }

    public function messages()
    {
        return [
            'parent_id'=>__('lang.macros_calculators')
        ];
    }
}
