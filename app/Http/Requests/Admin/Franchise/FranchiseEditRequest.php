<?php

namespace App\Http\Requests\Admin\Franchise;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FranchiseEditRequest extends FormRequest
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
                Rule::unique('tags', 'title')->ignore($id),
            ],
            'tag' => 'required|string',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.unique' => 'The title has already been taken.',
            'tag' => 'The tag field is required.',
            'tag.string' => 'The tag must be a string.',
            'status' => 'The status is required.'
        ];
    }
}
