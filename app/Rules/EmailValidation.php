<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailValidation implements Rule
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
        $black_domains = [
            'mjisolutions.com','mailinator.com','kokomail.site','rudegalshop.com','interia.pl','rudegalshop.com'
        ];
        $domainPart = explode('@', $value)[1] ?? null;

        if (!$domainPart) {
            return false;
        }

        if (in_array($domainPart, $black_domains)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('home.invaild_email');
    }
}
