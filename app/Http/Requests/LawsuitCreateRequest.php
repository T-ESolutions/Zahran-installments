<?php

namespace App\Http\Requests;

use App\Models\Lawsuit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LawsuitCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validation = [
            'type' => ['required', Rule::in(Lawsuit::TYPE)],
            'title' => 'required|string',
            'description' => 'nullable|string|max:6000',
            'amount' => 'required|numeric|min:0',
            'invoice_id' => 'required|exists:invoices,id',
            'customer_id' => 'required|exists:customers,id',
        ];

        return $validation;
    }

}
