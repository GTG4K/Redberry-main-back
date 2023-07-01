<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageOrNullRule implements Rule
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
        if (!$value) {
            return true; // Return true if the value is null or empty
        }

        if (!is_string($value) || !@getimagesize($value)) {
            return false; // Return false if the value is not a valid image
        }

        return true; // Return true if the value is a valid image
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be an image.';
    }
}
