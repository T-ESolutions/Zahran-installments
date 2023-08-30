<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SliderCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   public function rules()
   {
       $validation = [
           'image' => ['nullable','mimes:jpeg,jpg,png',  Rule::requiredIf(function() {  return Request::routeIs('slider.store');})],
           'url'=> ['required', 'url', 'max:255'],
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
