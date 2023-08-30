<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\ProductModuleTypeEnum;
use App\Enums\ProductTaxEnum;
use App\Enums\ProductTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {

        if ($this->module_type == ProductModuleTypeEnum::HEALTHY_PLAN->value) {
            $this->merge([
                'images' => null,
                'category_id' => null,
                'price' => null,
                'discount' => null,
                'add_tax' => ProductTaxEnum::INACTIVE->value,
                'products_ids' => null,
              ]);
        }
    }

    public function rules()
    {

         $validation = [
            'name_ar' => ['required', 'max:255', 'min:3'],
            'name_en' => ['required', 'max:255', 'min:3'],
            'description_ar' => 'required',
            'description_en' => 'required',

            'price' => ['nullable', 'numeric', 'gt:0',
                Rule::requiredIf($this->module_type ==ProductModuleTypeEnum::PRODUCT->value ||$this->module_type ==ProductModuleTypeEnum::BOTH->value)],

            'discount' => 'nullable|integer|between:1,100',

             'image' => ['nullable', 'mimes:jpeg,jpg,png', Rule::requiredIf(function () {
                return Request::routeIs('products.store');
            })],


            'category_id' => ['nullable',
                Rule::exists('categories', 'id'),
                Rule::requiredIf($this->module_type ==ProductModuleTypeEnum::PRODUCT->value ||$this->module_type ==ProductModuleTypeEnum::BOTH->value)],

            'type' => ['nullable', Rule::in([
                ProductTypeEnum::MAIN->value,
                ProductTypeEnum::BRANCH->value])
                ,Rule::requiredIf($this->module_type ==ProductModuleTypeEnum::PRODUCT->value ||$this->module_type ==ProductModuleTypeEnum::BOTH->value)],

            'module_type' => ['required', Rule::in(
                   [ProductModuleTypeEnum::HEALTHY_PLAN->value,
                    ProductModuleTypeEnum::PRODUCT->value,
                    ProductModuleTypeEnum::BOTH->value])],

             'add_tax' => ['required', Rule::in(
                 [ProductTaxEnum::ACTIVE->value,
                 ProductTaxEnum::INACTIVE->value])],

            'images' => ['nullable', Rule::requiredIf(function () {
                return (
                    Request::routeIs('products.store')
                    && ($this->module_type ==ProductModuleTypeEnum::PRODUCT->value ||$this->module_type ==ProductModuleTypeEnum::BOTH->value));
            })],

            'images.*' => ['image', 'mimes:jpeg,jpg,png', Rule::requiredIf(function () {
                return (
                    Request::routeIs('products.store')
                    && ($this->module_type ==ProductModuleTypeEnum::PRODUCT->value ||$this->module_type ==ProductModuleTypeEnum::BOTH->value));
            })],

            'products_ids' => 'nullable|array',
            'products_ids.*' => ['nullable', Rule::exists('products', 'id')->where('type', ProductTypeEnum::BRANCH->value)],
        ];

        return $validation;
    }


}
