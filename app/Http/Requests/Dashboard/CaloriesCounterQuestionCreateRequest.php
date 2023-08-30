<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\QuestionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CaloriesCounterQuestionCreateRequest extends FormRequest
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
           'type' => ['required', Rule::in([QuestionTypeEnum::TEXT->value, QuestionTypeEnum::NUMBER->value])],
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
