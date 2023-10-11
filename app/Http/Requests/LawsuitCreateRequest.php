<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LawsuitCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   public function rules()
   {
       $validation = [
              'amount' => 'required|numeric',
              'invoice_id' => 'required|exists:invoices,id',
              'customer_id' => 'required|exists:customers,id',
       ];

       return $validation;
   }

}
