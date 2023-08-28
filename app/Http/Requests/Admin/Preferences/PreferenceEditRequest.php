<?php

namespace App\Http\Requests\Admin\Preferences;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PreferenceEditRequest extends FormRequest
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
            'parent_preference_id' => 'required',
            'title' => 'required|string',
            'price' => 'required',
            'position' => 'required',
            // 'price_for_package' => 'required',
            // 'price_for_bundle' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'parent_preference_id.required' => 'The parent preference field is required.',
            'title.required' => 'The title fieldis required.',
            'title.string' => 'The title field must be a string.',
            'position.required' => 'The postion field is required.',
            'price.required' => 'The price field is required.',
            // 'price_for_package.required' => 'Is price for package field is required.',
            // 'price_for_bundle.required' => 'Is price for bundle field is required.',
            'status.required' => 'The status field is required.',
        ];
    }
}
