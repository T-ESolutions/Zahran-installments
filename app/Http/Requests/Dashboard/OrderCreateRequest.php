<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\OrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $array=OrderStatusEnum::getAllStatus();

        $numbers = array_values(array_map(function($subarray) {
            return $subarray[0];
        }, $array));

        $validation = [
            'status' => ['required',Rule::in($numbers)],
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
