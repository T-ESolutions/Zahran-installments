<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\BlockEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

         $validation = [
            'invoice_number' => 'nullable',
            'pay_day'=>['required', 'integer','min:1' ,'max:30'],
            'invoice_date'=>['required', 'date'],
            'customer_id'=>['required',Rule::exists('customers','id')->where('is_blocked',BlockEnum::UNBLOCKED->value)],
            'guarantors_id' => 'required|array',
            'guarantors_id.*' => ['required',Rule::exists('customers','id')->where('is_blocked',BlockEnum::UNBLOCKED->value)],
            'product'=>['nullable','string','max:255'],
            'note'=>['nullable','string','max:255'],
            'total_price'=>['required'],
            'deposit'=>['required'],
            'monthly_profit_percent'=>['required'],
            'months_count'=>['required'],
            'monthly_installment'=>['required'],
            'profit'=>['required'],
            'remaining_price'=>['required'],

        ];

        return $validation;
    }

}
