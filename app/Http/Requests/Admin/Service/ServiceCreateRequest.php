<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCreateRequest extends FormRequest
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
            'title'             => 'required|string|unique:services,title',
            'category_id'       => 'required|integer',
            'subcategory_id' => 'required|integer',
            'franchise_id'      => 'required|integer',
            'price'             => 'required|array|min:1',
            'price.*'           => 'required',
            'content'           => 'required|string',
            'position'          => 'required|integer',
            'preferences_show'  => 'required|integer',
            'status'            => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.unique' => 'The title field must be unique.',
            'category_id.required' => 'The category ID field is required.',
            'category_id.integer' => 'The category ID must be an number.',
            'subcategory_id.required' => 'The subcategory ID field is required.',
            'subcategory_id.integer' => 'The subcategory ID must be an number.',
            'franchise_id.required' => 'The franchise ID field is required.',
            'franchise_id.integer' => 'The franchise ID must be an number.',
            'price.required' => 'The price field is required.',
            'price.array' => 'The price field must be an array.',
            'price.min' => 'The price field must have at least one element.',
            'price.*.required' => 'Each price item must have a value.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content field must be a string.',
            'position.required' => 'The position field is required.',
            'position.integer' => 'The position field must be an number.',
            'preferences_show.required' => 'The preferences_show field is required.',
            'preferences_show.integer' => 'The preferences_show field must be an number.',
            'status.required' => 'The status field is required.',
            'status.integer' => 'The status field must be an number.',
        ];
    }
}
