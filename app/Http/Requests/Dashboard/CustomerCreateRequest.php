<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   public function rules()
   {
       $validation = [
           'name' => ['required','string', 'max:255'],
           'id_number' => ['required','numeric', 'digits:14' ],
           'address_id' => ['required','string', 'max:255'],
           'address' => ['nullable','string', 'max:255'],
           'phone' => ['required','numeric'],
           'phone2' => ['nullable','numeric'],
           'phone3' => ['nullable','numeric'],
           'governorate' => ['required','string', 'max:255'],
           'center' => ['required','string', 'max:255'],
           'note' => ['required','string', 'max:500'],
           'id_image'=>['nullable','image','mimes:jpeg,png,jpg'],
           'relatives'=>['required','array'],
           'relatives.*.name'=>['required','string', 'max:255', ],
           'relatives.*.phone'=>['required','string','max:255', ],
           'relatives.*.note'=>['required','string','max:255'],
       ];
       return $validation;
   }

}
