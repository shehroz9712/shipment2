<?php

namespace App\Http\Requests\Admin\EmailResponder;

use Illuminate\Foundation\Http\FormRequest;

class EmailResponderCreateRequest extends FormRequest
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
            'title' => 'required|string|unique:email_responders,title',
            'from_email' => 'required|string',
            'to_email' => 'required|string',
            'subject' => 'required|string',
            'content' => 'required|string|'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.unique' => 'The title has already been taken.',
            'from_email.required' => 'The from_email field is required.',
            'from_email.string' => 'The from_email must be a string.',
            'to_email.required' => 'The to_email field is required.',
            'to_email.string' => 'The to_email must be a string.',
            'subject.required' => 'The subject field is required.',
            'subject.string' => 'The subject must be a string.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content must be a string.',
        ];
    }
}
