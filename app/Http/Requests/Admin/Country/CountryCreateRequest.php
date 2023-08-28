<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Foundation\Http\FormRequest;

class CountryCreateRequest extends FormRequest
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
            'name'            => 'required',
            'iso3'            => 'required',
            'iso2'            => 'required',
            'numeric_code'    => 'required|integer',
            'phone_code'      => 'required|integer',
            'capital'         => 'required',
            'currency'        => 'required',
            'currency_name'   => 'required',
            'currency_symbol' => 'required',
            'tld'             => 'required',
            'native'          => 'required',
            'region'          => 'required',
            'subregion'       => 'required',
            'timezones'       => 'required',
            'translations'    => 'required',
            'latitude'        => 'required',
            'longitude'       => 'required',
            'emoji'           => 'required',
            'emojiU'          => 'required',
            'flag'            => 'required',
        ];
    }
}
