<?php

namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;

class DiscountCreateRequest extends FormRequest
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
            'country' => 'required|not_in:0',
            'code' => 'required|string|unique:discounts,code',
            'worth' => 'required|integer',
            'dtype' => 'required|not_in:0',
            'code_used' => 'required|not_in:0',
            'discount_for' => 'required|not_in:0',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'country.required' => 'The country field is required.',
            'country.not_in' => 'Please select a valid country.',
            'code.required' => 'The code field is required.',
            'code.string' => 'The code must be a string.',
            'code.unique' => 'The code has already been taken.',
            'worth.required' => 'The worth field is required.',
            'worth.integer' => 'The worth must be an integer.',
            'dtype.required' => 'The dtype field is required.',
            'dtype.not_in' => 'Please select a valid dtype.',
            'code_used.required' => 'The code used field is required.',
            'code_used.not_in' => 'Please select a valid code used.',
            'discount_for.required' => 'The discount for field is required.',
            'discount_for.not_in' => 'Please select a valid discount for.',
            'status.required' => 'The status field is required.',
        ];
    }
}
