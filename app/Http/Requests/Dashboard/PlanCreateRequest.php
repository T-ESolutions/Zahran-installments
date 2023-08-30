<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\PlanTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanCreateRequest extends FormRequest
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
           'answers_id' => ['nullable', 'array',Rule::requiredIf($this->type == PlanTypeEnum::PLAN->value)],
           'answers_id.*' => ['nullable',Rule::requiredIf($this->type == PlanTypeEnum::PLAN->value), Rule::exists('answers','id')],
       ];

       return $validation;
   }

}
