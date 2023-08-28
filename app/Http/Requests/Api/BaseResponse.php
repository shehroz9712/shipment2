<?php
namespace App\Http\Requests\Api;

use App\Http\Controllers\Api\v1\BaseController;
use Illuminate\Foundation\Http\FormRequest;

class BaseResponse extends FormRequest
{
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new BaseController();
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            $response->respondBadRequest(
                $validator->errors(),
                true,
                'Bad Request!'
            )
        );
    }
}
