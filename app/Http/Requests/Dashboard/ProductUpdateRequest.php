<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   public function rules()
   {
       $validation = [
           'example_input' => 'nullable',
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
