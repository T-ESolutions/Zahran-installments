<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\PlanTypeEnum;
use App\Enums\ProductModuleTypeEnum;
use App\Enums\ProductTaxEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HealthyPlanCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validation = [
            'name_ar' => ['required', 'max:255', 'min:3'],
            'name_en' => ['required', 'max:255', 'min:3'],
            'description_ar' => 'required',
            'description_en' => 'required',
            'price' => ['required', 'numeric', 'gt:0'],
            'discount' => 'nullable|integer|between:1,100',
            'factor' => ['required', 'numeric', 'gt:0'],
            'add_tax' => ['required', Rule::in([ProductTaxEnum::ACTIVE->value, ProductTaxEnum::INACTIVE->value])],
            'calories' => ['required', 'numeric', 'gt:0'],
            'calories_from' => ['required', 'numeric', 'gt:0'],
            'calories_to' => ['required', 'numeric', 'gt:calories_from'],
            'image' => ['nullable', 'mimes:jpeg,jpg,png', Rule::requiredIf(function () {
                return Request::routeIs('healthy_plan.store');
            })],
            'products_ids' => 'required|array',
            'products_ids.*' => ['required', Rule::exists('products', 'id')->where('module_type', ProductModuleTypeEnum::HEALTHY_PLAN->value)],
            'plans_ids' => 'required|array',
            'plans_ids.*' => ['required', Rule::exists('plans', 'id')->where('type', PlanTypeEnum::PLAN->value)],

            'images' => ['nullable', Rule::requiredIf(function () {
                return Request::routeIs('healthy_plan.store');
            })],

            'images.*' => ['image', 'mimes:jpeg,jpg,png', Rule::requiredIf(function () {
                return Request::routeIs('healthy_plan.store');
            })],
        ];

        return $validation;
    }

}
