<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\BlockEnum;
use App\Enums\InvoiceTypeEnum;
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
            'guarantors_id' => 'nullable|array',
            'guarantors_id.*' => ['nullable',Rule::exists('customers','id')->where('is_blocked',BlockEnum::UNBLOCKED->value)],
            'product'=>['nullable','string','max:255'],
            'note'=>['nullable','string','max:255'],
            'total_price'=>['required'],
            'deposit'=>['required'],
            'invoice_type'=>['required'],
            'invoice_id'=>['nullable','string','max:255',Rule::requiredIf(function () {
                return $this->invoice_type ==  InvoiceTypeEnum::INVOICE->value;
            }),Rule::exists('invoices','id')],
            'monthly_profit_percent'=>['required'],
            'months_count'=>['required'],
            'monthly_installment'=>['required'],
            'profit'=>['required'],
            'remaining_price'=>['required'],
        ];

        return $validation;
    }

}
