<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPhone implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!empty($value)){

            $non_digits = [' ','(',')','-','.','+'];
            $nums = str_replace($non_digits,'',$value);

            if(strlen($nums) >=7 && strlen($nums)<=15 && preg_match('/^[0-9]*$/', $nums)){
                return true;
            }
        }else{
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The phone number is invalid.';
    }
}
