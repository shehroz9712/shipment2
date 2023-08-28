<?php

namespace App\Http\Requests\Admin\City;

use Illuminate\Foundation\Http\FormRequest;

class CityEditRequest extends FormRequest
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
            'name'       => 'required|string',
            'status'     => 'required|integer',
            'country_id' => 'required|integer',
            'latitude'   => 'required|numeric|between:0,99999.99',
            'longitude'  => 'required|numeric|between:0,99999.99',
            'timezones'  => 'required|string',
        ];
    }
}
