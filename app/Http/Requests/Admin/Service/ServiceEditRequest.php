<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceEditRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('services', 'title')->ignore($id),
            ],
            'category_id'     => 'required|integer',
            'franchise_id.*'  => 'required|integer',
            'country_id.*'    => 'required|integer',
            'sub_category_id' => 'required|integer',
            'price.*'         => 'required|integer',
            'content'         => 'required|string',
            'position'        => 'required|integer',
            'status'          => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.required'            => 'The Title field is required.',
            'title.string'              => 'The Title must be a string.',
            'title.unique'              => 'The Title has already been taken.',
            'category_id.required'      => 'Please select Category.',
            'category_id.integer'       => 'The Category must be a integer.',
            'sub_category_id.required'  => 'Please select Subcategory.',
            'sub_category_id.integer'   => 'The Subcategory must be a integer.',
            'franchise_id.required'     => 'Please select Franchise.',
            'franchise_id.integer'      => 'The Franchise must be a integer.',
            'price.required'            => 'The Price field is required.',
            'content.required'          => 'The Content field is required.',
            'content.string'            => 'The Content must be a string.',
            'position.required'         => 'The Position field is required.',
            'position.integer'          => 'The Position must be a integer.',
            'preferences_show.required' => 'The Preferences field is required.',
            'preferences_show.integer'  => 'The Preferences must be a integer.',
            'status.required'           => 'The Status field is required.',
            'status.integer'            => 'The Status must be a integer.',
        ];
    }
}
