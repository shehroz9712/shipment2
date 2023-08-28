<?php
namespace App\Helpers;

use App\Models\Module;
use Exception;
use Illuminate\Validation\ValidationException;

/**
 * This Class is to create common functions
 * Class Functions
 * @package App\Common
 */
class Validation
{
    /**
     * This function is to get parent user
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     *
     * @throws ValidationException
     */
    public static function validateDate()
    {
        try {
            return function ($attribute, $value, $fail) {
                return preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\s[A-Za-z]{3,},\s[0-9]{4}$/", $value);
            };
        } catch (Exception $ex) {
            // Log message to error log
            report($ex->getMessage());
        }
    }


}
