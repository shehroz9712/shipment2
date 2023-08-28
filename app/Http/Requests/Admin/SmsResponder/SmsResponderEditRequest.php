<?php

namespace App\Http\Requests\Admin\SmsResponder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SmsResponderEditRequest extends FormRequest
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
                Rule::unique('sms_responders', 'title')->ignore($id),
            ],
            'content' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.unique' => 'The title has already been taken.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content must be a string.',
        ];
    }
}
