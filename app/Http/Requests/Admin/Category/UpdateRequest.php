<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title'                  => 'required|string',
            'image'                  => 'mimetypes:jpeg, jpg, png',
            'position'               => 'required|integer',
            'preferences_show'       => 'required|integer',
            'popup_message'          => 'required|string',
            'status'                 => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter a Title',
            'title.string' => 'Title must be a string',
        ];
    }
}
