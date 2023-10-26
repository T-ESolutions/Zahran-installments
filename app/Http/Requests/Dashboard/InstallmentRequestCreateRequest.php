<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class InstallmentRequestCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   public function rules()
   {
       $validation = [
           'customers_ids' => 'required|array',
           'customers_ids.*' => 'required|exists:customers,id',
           'customer_id' => 'required|exists:customers,id',
           'deposit' => 'required|gt:0',
           'price' => 'required|gt:deposit',
           'product' => 'required|max:191',
       ];

       return $validation;
   }

}
