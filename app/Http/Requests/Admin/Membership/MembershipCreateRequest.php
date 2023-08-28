<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class MembershipCreateRequest extends FormRequest
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
            'member_id'      => 'required|integer',
            'package_id'     => 'required|integer',
            'card_id'        => 'required|integer',
            'price'          => 'required|integer',
            'status'         => 'required',
            // 'payment_method' => 'required|string',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after:start_date',
        ];
    }

    public function messages()
    {
        return [
            'member_id.required' => 'Please select Member.',
            'member_id.integer'  => 'The Member must be a integer.',
            'package_id.required'=> 'Please select Package.',
            'package_id.integer' => 'The Package must be a integer.',
            'card_id.required'   => 'Please select Card.',
            'card_id.integer'    => 'The Card must be a integer.',
            'price.required'     => 'The Price field is required.',
            'price.integer'      => 'The Price must be a integer.',
            'status.required'    => 'The Status field is required.',
            'start_date.required'=> 'The Start Date field is required.',
            'start_date.date'    => 'The Start Date must be a date.',
            'end_date.required'  => 'The End Date field is required.',
            'end_date.date'      => 'The End Date must be a date.',
            'end_date.after'     => 'The End Date must be a date after Start Date.',
        ];
    }
}
