<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerImportRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   public function rules()
   {
       $validation = [
           'file_excel' => ['required','file', 'mimes:xlsx,csv'],
       ];
       return $validation;
   }

}
