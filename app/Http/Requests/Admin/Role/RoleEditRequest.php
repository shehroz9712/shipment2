<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleEditRequest extends FormRequest
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
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your role name.',
            'name.unique' => 'The role has already created.',
            'name.string' => 'The role must be a string.',
            'guard_name.required' => 'Please enter your guard name.',
        ];
    }
}
