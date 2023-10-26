<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required',  'email', 'max:191', Rule::unique('admins','email')->ignore($this->id)],
            'phone' => ['required', 'numeric','digits_between:8,14', Rule::unique('admins','phone')->ignore($this->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['nullable' ,'same:password'],
        ];
    }
}
