<?php

namespace App\Http\Requests\Admin\CustomerSupport;

use Illuminate\Foundation\Http\FormRequest;

class CustomerSupportCreateRequest extends FormRequest
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
            'first_name' => 'required',
            'username' => 'required|min:8|max:15|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
            'password_confirmation' => 'required|same:password',
            //'mobileno' => 'required|regex:/^\+\d{1,3}\s\d{1,14}$/',
            'mobileno' => 'required',
            'role_id' => 'required|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please enter your first name.',
            'username.required' => 'Please enter your username.',
            'username.min' => 'The username must be at least :min characters.',
            'username.max' => 'The username may not be greater than :max characters.',
            'username.unique' => 'The username has already been taken.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already in use.',
            'password.required' => 'Please enter a password.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'password_confirmation.required' => 'Please confirm your password.',
            'password_confirmation.same' => 'The password confirmation does not match.',
            'mobileno.required' => 'Please enter your mobile number.',
            'mobileno.regex' => 'Please enter a valid mobile number with the country code.',
            'role_id.required' => 'Please select a role.',
            'role_id.not_in' => 'Please select a valid role.',
        ];
    }
}
