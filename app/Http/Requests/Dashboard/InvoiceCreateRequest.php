<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceCreateRequest extends FormRequest
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

}
