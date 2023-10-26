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
           'name' => ['required','string', 'max:191'],
           'id_number' => ['required','numeric', 'digits:14' ],
           'address_id' => ['required','string', 'max:191'],
           'address' => ['nullable','string', 'max:191'],
           'phone' => ['required','numeric'],
           'phone2' => ['nullable','numeric'],
           'phone3' => ['nullable','numeric'],
           'governorate' => ['required','string', 'max:191'],
           'center' => ['required','string', 'max:191'],
           'note' => ['nullable','string', 'max:500'],
           'id_image'=>['nullable','image','mimes:jpeg,png,jpg'],
           'relatives'=>['nullable','array'],
           'relatives.*.name'=>['nullable','string', 'max:191', ],
           'relatives.*.phone'=>['nullable','string','max:191', ],
           'relatives.*.note'=>['nullable','string','max:191'],
       ];
       return $validation;
   }

}
