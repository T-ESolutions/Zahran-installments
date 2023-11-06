<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\BlockEnum;
use App\Enums\InvoiceTypeEnum;
use App\Models\Invoice;
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
            'pay_day' => ['required', 'integer', 'min:1', 'max:30'],
            'pay_month' => ['required', 'numeric', 'min:1', 'max:12'],
            'pay_year' => ['required', 'numeric', 'min:2021'],
            'transaction_number' => ['required', 'string', 'max:191'],
            'invoice_date' => ['required', 'date'],
            'customer_id' => ['required', Rule::exists('customers', 'id')->where('is_blocked', 0)],
            'guarantors_id' => 'nullable|array',
            'guarantors_id.*' => ['nullable', Rule::exists('customers', 'id')->where('is_blocked', 0)],
            'product' => ['required', 'string', 'max:191'],
            'note' => ['nullable', 'string', 'max:191'],
            'total_price' => ['required'],
            'last_deposit' => ['required', 'numeric', 'min:0'],
            'current_deposit' => ['required', 'numeric', 'min:0'],
            'deposit' => ['required', 'numeric', 'min:0'],
            'months_total_percentage' => ['required', 'numeric', 'min:0'],
            'profit_percentage' => ['required', 'numeric', 'min:0'],
            'installment_price' => ['required', 'numeric', 'min:0'],
            'division_type' => ['required', 'in:dynamic,manual'],
            'installment_price_divided' => ['nullable', 'array'],

            'invoice_type' => ['required', Rule::in(Invoice::INVOICE_TYPE)],
            'invoice_id' => ['nullable', Rule::requiredIf(function () {
                return $this->invoice_type == 3;
            }), Rule::exists('invoices', 'id')],
            'paper_amount' => ['nullable', 'numeric', 'min:0', Rule::requiredIf($this->invoice_type == 1)],

            'monthly_profit_percent' => ['required'],
            'months_count' => ['required'],
            'monthly_installment' => ['required'],
            'profit' => ['required'],
            'remaining_price' => ['required'],
        ];

        return $validation;
    }

}
