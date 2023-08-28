<?php

namespace App\Http\Requests\Admin\Package;

use Illuminate\Foundation\Http\FormRequest;

class PackageCreateRequest extends FormRequest
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
            'name' => 'required|string|unique:packages,name',
            'tag_line' => 'required|string',
            'price' => 'required|integer',
            'type' => 'required|integer',
            'short_description' => 'required|string',
            'worth' => 'required|integer',
            'worth_type' => 'required|integer',
            //'description'       => 'required|string',
            //'trial_period'      => 'required|integer',
            //'popular' => 'required|integer',
            'status' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name field is required.',
            'name.string' => 'The Name must be a string.',
            'name.unique' => 'The Name has already been taken.',
            'price.required' => 'The Price field is required.',
            'price.integer' => 'The Price must be a integer.',
            'type.required' => 'Please select Type.',
            'type.integer' => 'The Type must be a integer.',
            'worth.required' => 'Please select worth.',
            'worth.integer' => 'The worth must be a integer.',
            'worth_type.required' => 'Please select worth type.',
            'worth_type.integer' => 'The worth type must be a integer.',
            'description.required' => 'The Description field is required.',
            'description.string' => 'The Description must be a string.',
            'short_description.required' => 'The Short Description field is required.',
            'short_description.string' => 'The Short Description must be a string.',
            'tag_line.required' => 'The Tag Line field is required.',
            'tag_line.string' => 'The Tag Line must be a string.',
            'trial_period.required' => 'The Preferences field is required.',
            'trial_period.integer' => 'The Preferences must be a integer.',
            'popular.required' => 'The Popular field is required.',
            'popular.integer' => 'The Popular must be a integer.',
            'status.required' => 'The Status field is required.',
            'status.integer' => 'The Status must be a integer.',
        ];
    }
}
