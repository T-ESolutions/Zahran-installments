<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FinishCashRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:invoices',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'discount_month' => 'required|numeric|min:1',
            'discount_remain_installments' => 'required|numeric|min:0',
            'discount_value' => 'required|numeric|min:0',
            'discount_money_collected' => 'required|numeric|min:0',
            ];
    }
}
